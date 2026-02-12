<?php
// app/Services/AI/BlogAIGenerator.php

namespace App\Services\AI;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogAIGenerator
{
    private $apiKey;
    private $baseUrl = 'https://api.openai.com/v1/chat/completions';
    
    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }
    
    /**
     * توليد مقالة طبية كاملة
     */
    public function generateMedicalArticle(array $params): array
    {
        $prompt = $this->buildMedicalPrompt($params);
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post($this->baseUrl, [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $this->getSystemPrompt($params['category_id'])
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 4000
            ]);
            
            if ($response->successful()) {
                $content = $response->json()['choices'][0]['message']['content'];
                return $this->parseAIResponse($content, $params);
            }
            
        } catch (\Exception $e) {
            Log::error('AI Generation Error: ' . $e->getMessage());
        }
        
        return $this->generateFallbackContent($params);
    }
    
    /**
     * إنشاء الـ Prompt المناسب
     */
    private function buildMedicalPrompt(array $params): string
    {
        $category = BlogCategory::find($params['category_id']);
        $wordCount = $params['word_count'] ?? 1500;
        
        return "اكتب مقالاً طبياً بالعربية الفصحى حول موضوع: {$params['topic']}
                
                المتطلبات:
                1. التخصص: {$category->name}
                2. عدد الكلمات: {$wordCount} كلمة
                3. نوع المحتوى: {$params['content_type']}
                4. الكلمات المفتاحية: " . implode(', ', $params['keywords'] ?? []) . "
                
                مخرجات المقال:
                1. عنوان رئيسي جذاب
                2. مقدمة شيقة (100-150 كلمة)
                3. محتوى رئيسي مقسم لعناوين فرعية
                4. خاتمة مع نصيحة طبية
                5. 5 أسئلة شائعة مع إجابات
                6. وصف SEO (meta description) 150-160 حرف
                7. 10 هاشتاقات طبية مناسبة
                
                أخرج النتيجة بتنسيق JSON:
                {
                    \"title\": \"...\",
                    \"excerpt\": \"...\",
                    \"content\": \"...\",
                    \"meta_title\": \"...\",
                    \"meta_description\": \"...\",
                    \"faq_json\": [{...}],
                    \"target_keywords\": [...],
                    \"suggested_hashtags\": [...]
                }";
    }
    
    /**
     * الـ System Prompt حسب التخصص
     */
    private function getSystemPrompt($categoryId): string
    {
        $category = BlogCategory::find($categoryId);
        
        $prompts = [
            'صحة القلب' => 'أنت طبيب قلب متخصص، اكتب محتوى دقيق وعلمي عن أمراض القلب والوقاية منها.',
            'التغذية' => 'أنت أخصائي تغذية معتمد، قدم نصائح غذائية صحيحة قابلة للتطبيق.',
            'طب الأطفال' => 'أنت طبيب أطفال، اكتب محتوى مناسب للأهالي بلغة بسيطة وواضحة.',
            'الصحة النفسية' => 'أنت معالج نفسي، قدم محتوى داعم وعلمي عن الصحة النفسية.',
            'default' => 'أنت طبيب عام متخصص في كتابة المحتوى الطبي باللغة العربية.'
        ];
        
        return $prompts[$category->name] ?? $prompts['default'];
    }
    
    /**
     * معالجة استجابة الـ AI
     */
    private function parseAIResponse(string $content, array $params): array
    {
        // محاولة استخراج JSON
        preg_match('/\{.*\}/s', $content, $matches);
        
        if (!empty($matches)) {
            $data = json_decode($matches[0], true);
            
            if (json_last_error() === JSON_ERROR_NONE) {
                return array_merge($data, [
                    'word_count' => str_word_count($data['content']),
                    'reading_time' => ceil(str_word_count($data['content']) / 200) . ' min',
                    'flesch_score' => $this->calculateReadability($data['content'])
                ]);
            }
        }
        
        // إذا فشل JSON، نتعامل مع النص العادي
        return $this->parsePlainTextResponse($content, $params);
    }
    
    /**
     * تحليل النص العادي إذا فشل JSON
     */
    private function parsePlainTextResponse(string $content, array $params): array
    {
        $lines = explode("\n", $content);
        
        return [
            'title' => $params['topic'] . ' - دليل طبي شامل',
            'excerpt' => $this->extractExcerpt($content, 150),
            'content' => $content,
            'meta_title' => $params['topic'] . ' | SehaSave',
            'meta_description' => 'مقال طبي عن ' . $params['topic'] . ' مع معلومات شاملة ونصائح طبية',
            'faq_json' => $this->extractFAQFromContent($content),
            'target_keywords' => $params['keywords'] ?? [],
            'suggested_hashtags' => ['#صحة', '#طبي', '#نصيحة_طبية', '#SehaSave'],
            'word_count' => str_word_count($content),
            'reading_time' => ceil(str_word_count($content) / 200) . ' min'
        ];
    }
    
    /**
     * استخراج ملخص من المحتوى
     */
    private function extractExcerpt(string $content, int $length = 150): string
    {
        $sentences = preg_split('/[.!؟]/', $content);
        $excerpt = '';
        
        foreach ($sentences as $sentence) {
            if (str_word_count($excerpt . $sentence) > $length) {
                break;
            }
            $excerpt .= $sentence . '. ';
        }
        
        return trim($excerpt);
    }
    
    /**
     * استخراج أسئلة شائعة من المحتوى
     */
    private function extractFAQFromContent(string $content): array
    {
        $faqs = [];
        $lines = explode("\n", $content);
        
        foreach ($lines as $line) {
            if (preg_match('/(سؤال|هل|كيف|متى|لماذا|ما).*\؟/', $line)) {
                $faqs[] = [
                    'question' => trim($line),
                    'answer' => $this->findAnswer($lines, $line)
                ];
                
                if (count($faqs) >= 5) break;
            }
        }
        
        return $faqs;
    }
    
    private function findAnswer(array $lines, string $question): string
    {
        $questionIndex = array_search($question, $lines);
        
        if ($questionIndex !== false && isset($lines[$questionIndex + 1])) {
            return $lines[$questionIndex + 1];
        }
        
        return 'الإجابة موجودة في المقال أعلاه.';
    }
    
    /**
     * حساب قابلية القراءة
     */
    private function calculateReadability(string $text): float
    {
        $words = str_word_count($text);
        $sentences = preg_split('/[.!؟]/', $text);
        $sentenceCount = count(array_filter($sentences));
        
        if ($words === 0 || $sentenceCount === 0) {
            return 60.0;
        }
        
        // صيغة Flesch Reading Ease مبسطة للعربية
        $score = 206.835 - (1.015 * ($words / $sentenceCount)) - (84.6 * ($this->countSyllables($text) / $words));
        
        return max(0, min(100, $score));
    }
    
    private function countSyllables(string $text): int
    {
        $arabicVowels = ['ا', 'و', 'ي', 'ى', 'أ', 'إ', 'ؤ', 'ئ', 'ة'];
        $count = 0;
        
        foreach (mb_str_split($text) as $char) {
            if (in_array($char, $arabicVowels)) {
                $count++;
            }
        }
        
        return max(1, $count);
    }
    
    /**
     * محتوى بديل إذا فشل الـ AI
     */
    private function generateFallbackContent(array $params): array
    {
        return [
            'title' => $params['topic'] . ' - معلومات طبية هامة',
            'excerpt' => 'مقال طبي شامل عن ' . $params['topic'] . ' مع نصائح للوقاية والعلاج.',
            'content' => $this->generateTemplateContent($params),
            'meta_title' => $params['topic'] . ' | SehaSave',
            'meta_description' => 'تعرف على ' . $params['topic'] . ' وأهم المعلومات الطبية والنصائح.',
            'faq_json' => [
                ['question' => 'ما هو ' . $params['topic'] . '؟', 'answer' => 'شرح مفصل في المقال.'],
                ['question' => 'كيف يمكن الوقاية؟', 'answer' => 'نصائح وقائية في المقال.']
            ],
            'target_keywords' => $params['keywords'] ?? [],
            'suggested_hashtags' => ['#صحة', '#طبي', '#نصيحة'],
            'word_count' => 800,
            'reading_time' => '4 دقائق'
        ];
    }
    
    private function generateTemplateContent(array $params): string
    {
        $templates = [
            'article' => "
                <h2>مقدمة عن {$params['topic']}</h2>
                <p>{$params['topic']} من المواضيع الصحية الهامة التي تهم الكثير من الناس.</p>
                
                <h2>أهم المعلومات الطبية</h2>
                <p>هنا ستجد المعلومات الطبية الدقيقة عن {$params['topic']}.</p>
                
                <h2>نصائح للوقاية</h2>
                <ul>
                    <li>نصيحة وقائية أولى</li>
                    <li>نصيحة وقائية ثانية</li>
                    <li>نصيحة وقائية ثالثة</li>
                </ul>
                
                <h2>الخلاصة</h2>
                <p>{$params['topic']} موضوع مهم يحتاج للاهتمام والمتابعة.</p>
            ",
            'guide' => "
                <h2>دليل شامل عن {$params['topic']}</h2>
                <p>في هذا الدليل ستتعلم كل ما تحتاجه عن {$params['topic']}.</p>
                
                <h2>الخطوة الأولى: الفهم</h2>
                <p>فهم أساسيات {$params['topic']}.</p>
                
                <h2>الخطوة الثانية: التطبيق</h2>
                <p>كيف تطبق ما تعلمته.</p>
                
                <h2>الخطوة الثالثة: المتابعة</h2>
                <p>متابعة النتائج والتعديلات.</p>
            "
        ];
        
        return $templates[$params['content_type']] ?? $templates['article'];
    }
    
    /**
     * تحسين مقال موجود
     */
    public function improveExistingArticle(Blog $blog): array
    {
        $prompt = "قم بتحسين المقال التالي مع الحفاظ على المضمون العلمي:
        
        العنوان: {$blog->title}
        
        المحتوى: {$blog->content}
        
        المطلوب:
        1. تحسين SEO للعنوان والوصف
        2. تحسين قابلية القراءة
        3. إضافة عناوين فرعية
        4. تحسين الهيكل
        5. اقتراح هاشتاقات جديدة
        
        أخرج النتيجة بنفس تنسيق JSON السابق.";
        
        // ... implementation similar to generateMedicalArticle
    }
    
    /**
     * اقتراح عناوين لمقال
     */
    public function suggestTitles(string $topic, int $count = 5): array
    {
        $prompt = "اقترح {$count} عناوين جذابة لمقال طبي عن: {$topic}
        
        الشروط:
        1. باللغة العربية الفصحى
        2. جذابة ومشوقة
        3. تحتوي على كلمات مفتاحية
        4. مناسبة لمحركات البحث
        5. طول كل عنوان 50-70 حرف
        
        أخرج النتيجة كقائمة JSON.";
        
        // ... implementation
    }
    
    /**
     * توليد وصف SEO
     */
    public function generateSEOMeta(string $title, string $content): array
    {
        $prompt = "اكتب وصف SEO (meta description) للمقال التالي:
        
        العنوان: {$title}
        
        المحتوى: " . substr($content, 0, 500) . "
        
        الشروط:
        1. 150-160 حرف
        2. يحتوي على كلمات مفتاحية
        3. جذاب للمستخدمين
        4. يدعو للنقر
        
        أخرج النتيجة كـ JSON.";
        
        // ... implementation
    }
}