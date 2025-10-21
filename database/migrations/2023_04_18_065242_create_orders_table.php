<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->longText('order_number',10)->unique();
            // $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('gop_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('address')->nullable();
            //note
            $table->string('note')->nullable();
//payment
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');

            $table->enum('condition',['pending','process','complete','cancelled'])->default('pending');
//empid
            $table->string('empid')->nullable();

           // $table->float('sub_total',8,2)->default(0);
            $table->float('total_amount',8,2)->default(0);
            $table->float('coupon',8,2)->default(0)->nullable();
            $table->float('delivery_charge',8,2)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->string('sessoin_id')->nullable();
            $table->string('product_type')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
