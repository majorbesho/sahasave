<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_result_details', function (Blueprint $table) {
            $table->id();

            // مفتاح خارجي يربط بتفاصيل التقرير الرئيسي
            $table->foreignId('lab_result_id')->constrained('lab_results')->onDelete('cascade');

            // اسم التحليل الفرعي (مثال: Glucose, Hemoglobin, White Blood Cells)
            $table->string('test_name')->comment('Name of the individual test item (e.g., Glucose, Hemoglobin)');

            // كود التحليل الفرعي (مثال: LOINC code for Glucose)
            $table->string('test_code')->nullable()->comment('Standardized code for the individual test item');

            // القيمة الناتجة للتحليل
            $table->string('result_value')->comment('The actual value of the test result (can be numeric or text like "Negative")');

            // وحدة القياس (مثال: mg/dL, g/dL, %)
            $table->string('unit')->nullable()->comment('Unit of measurement for the result');

            // المجال المرجعي الأدنى (للقيم الرقمية)
            $table->decimal('reference_range_min', 10, 3)->nullable()->comment('Lower bound of the reference range');

            // المجال المرجعي الأعلى (للقيم الرقمية)
            $table->decimal('reference_range_max', 10, 3)->nullable()->comment('Upper bound of the reference range');

            // المجال المرجعي كنص (للقيم غير الرقمية أو المعقدة، مثال: "< 5.0", "Negative")
            $table->string('reference_range_text')->nullable()->comment('Textual representation of the reference range (e.g., "< 5.0", "Negative")');

            // هل هذه النتيجة غير طبيعية؟
            $table->boolean('is_abnormal')->default(false)->comment('Flag if the specific test result is abnormal');

            // علم يشير إلى نوع الشذوذ (مثال: H للارتفاع، L للانخفاض، A للشاذ)
            $table->string('abnormal_flag')->nullable()->comment('Flag indicating type of abnormality (e.g., H for High, L for Low, A for Abnormal)');

            // ملاحظات خاصة بهذا التحليل الفرعي
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_result_details');
    }
}
