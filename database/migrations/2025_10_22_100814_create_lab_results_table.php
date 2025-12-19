<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();

            // ==================== Foreign Keys ====================
            // المريض الذي يخصه هذا التقرير
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

            // الطبيب الذي طلب التحاليل (يمكن أن يكون null إذا تم الطلب من قبل المريض مباشرة أو جهة أخرى)
            $table->foreignId('ordered_by_doctor_id')->nullable()->constrained('users')->onDelete('set null');

            // العيادة/المركز الصحي الذي تم من خلاله طلب التحاليل
            // (يجب أن يكون لديك جدول 'clinics' أو 'health_centers' أو ما شابه)
            // $table->foreignId('medical')->nullable()->constrained('clinics')->onDelete('set null');

            // المختبر الذي أجرى التحاليل
            // (يجب أن يكون لديك جدول 'lab_providers' أو 'labs' أو ما شابه)
            //$table->foreignId('lab_provider_id')->nullable()->constrained('lab_providers')->onDelete('set null');

            // ==================== General Report Information ====================
            // عنوان التقرير (مثال: "Complete Blood Count", "Lipid Panel")
            $table->string('report_title')->comment('Human-readable title of the lab report');

            // كود التقرير أو نوع التحليل الرئيسي (مثال: CBC, CMP, TSH)
            $table->string('report_code')->nullable()->comment('Standardized code for the lab test/panel (e.g., LOINC code)');

            // رقم تعريف التقرير من المختبر الخارجي
            $table->string('external_report_id')->nullable()->unique()->comment('Unique identifier from the external lab');

            // تاريخ ووقت طلب التحاليل
            $table->dateTime('order_date')->nullable();

            // تاريخ ووقت الحصول على النتائج
            $table->dateTime('result_date')->comment('Date and time when the results were available');

            // حالة التقرير (مثال: pending, completed, reviewed, canceled)
            $table->string('status')->default('completed')->comment('Status of the lab report (e.g., pending, completed, reviewed)');

            // ملاحظات عامة حول التقرير
            $table->text('overall_notes')->nullable();

            // مسار ملف التقرير الأصلي (PDF أو صورة) إذا كان متاحاً
            $table->string('attachment_path')->nullable()->comment('File path to the original lab report (PDF, image, etc.)');

            // هل يوجد أي نتيجة غير طبيعية في هذا التقرير بشكل عام؟
            $table->boolean('is_abnormal_overall')->default(false)->comment('Flag if any result within the report is abnormal');

            // ==================== Review Information ====================
            // الطبيب الذي قام بمراجعة التقرير
            $table->foreignId('reviewed_by_doctor_id')->nullable()->constrained('users')->onDelete('set null');

            // تاريخ ووقت مراجعة التقرير
            $table->dateTime('reviewed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results');
    }
}
