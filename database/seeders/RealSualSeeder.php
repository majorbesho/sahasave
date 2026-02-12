<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Support\Str;

class RealSualSeeder extends Seeder
{
    public function run()
    {
        $authorId = User::first()?->id ?? 1;
        $categoryId = BlogCategory::where('name', 'like', '%عظام%')->first()?->id ??
            BlogCategory::first()?->id ?? 1;

        $blogs = [
            [
                'title' => 'هل ألم الركبة بعد الصلاة طبيعي؟ أم إنذار لانزلاق غضروفي؟',
                'excerpt' => 'كثيرون في دبي يشكون من ألم الركبة بعد السجود. متى يكون طبيعيًا؟ ومتى يحتاج رنين مغناطيسي؟',
                'content' => '<p>السؤال الحقيقي: "أصلي الصلوات الخمس، وبعد الفجر أحس بألم حاد في مقدمة الركبة. هل هذا طبيعي مع التقدم في العمر؟"</p><p>الجواب: ليس طبيعيًا — لكنه شائع جدًا في دبي بسبب الجلوس على السجاد الصلب + قلة فيتامين د.</p><h2>3 أسباب محتملة</h2><ul><li>التهاب وتر الرضفة (Jumper’s Knee)</li><li>تآكل غضروف الركبة المبكر</li><li>خلل في محاذاة القدم (Flat Feet)</li></ul><p>نصيحة SehaSave: أول 3 أشهر من بدء الأعراض هي الفرصة الأفضل للعلاج غير الجراحي.</p>',
                'status' => 'published',
                'meta_keywords' => 'ألم الركبة, الصلاة, عظام دبي, انزلاق غضروفي, طبيب عظام',
                'faq_json' => [
                    [
                        'question' => 'هل ألم الركبة بعد الصلاة يعني انزلاق غضروفي؟',
                        'answer' => 'ليس بالضرورة. 70% من الحالات تكون بسبب التهاب أوتار، وليس انزلاق. الفحص السريري + الرنين يوضح التشخيص.'
                    ],
                    [
                        'question' => 'كم يستغرق علاج ألم الركبة غير الجراحي؟',
                        'answer' => 'من 4 إلى 8 أسابيع مع تمارين موجهة وعلاج طبيعي — بحسب مركز دبي للعظام 2024.'
                    ],
                    [
                        'question' => 'هل فيتامين د يسبب ألم في الركبة؟',
                        'answer' => 'نقصه يسببه، وليس زيادته. 85% من المرضى في الإمارات يعانون من نقص فيتامين د — ويرتبط مباشرة بألم المفاصل.'
                    ]
                ],
                'author_credentials' => 'فريق دعم طبي معتمد من DHA دبي',
                'sources_references' => [
                    'دليل DHA 2024 لآلام المفاصل',
                    'Mayo Clinic: Patellar Tendinitis',
                    'دراسة جامعة محمد بن راشد: نقص فيتامين د في الإمارات'
                ],
                'target_keywords' => ['ألم الركبة بعد الصلاة', 'طبيب عظام دبي', 'انزلاق غضروفي'],
                'schema_type' => 'MedicalWebPage'
            ],
            // يمكنك إضافة بقية المقالات بنفس الطريقة...
        ];

        foreach ($blogs as $blog) {
            $slug = Str::slug($blog['title']);
            Blog::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $blog['title'],
                    'excerpt' => $blog['excerpt'],
                    'content' => $blog['content'],
                    'status' => $blog['status'],
                    'visibility' => 'public',
                    'content_type' => 'faq',
                    'reading_time' => '4 min read',
                    'views' => 0,
                    'likes' => 0,
                    'shares' => 0,
                    'author_id' => $authorId,
                    'category_id' => $categoryId,
                    'meta_title' => $blog['title'] . ' | SehaSave دبي',
                    'meta_description' => $blog['excerpt'],
                    'meta_keywords' => $blog['meta_keywords'],
                    'schema_type' => $blog['schema_type'] ?? 'MedicalWebPage',
                    'author_credentials' => $blog['author_credentials'] ?? 'فريق طبي معتمد',
                    'sources_references' => $blog['sources_references'] ?? json_encode([]),
                    'target_keywords' => $blog['target_keywords'] ?? json_encode([]),
                    'faq_json' => $blog['faq_json'] ?? null,
                    'word_count' => str_word_count(strip_tags($blog['content'])),
                    'flesch_score' => 65,
                    'featured' => false,
                    'published_at' => now(),
                    'last_updated' => now(),
                ]
            );
        }
    }
}
