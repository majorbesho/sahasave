<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_type'); // Broker, Carrier, Shipper, Admin
            $table->unsignedBigInteger('receiver_id');
            $table->string('receiver_type'); // Broker, Carrier, Shipper, Admin
            $table->timestamps();

            // استخدام اسم قصير للـ Unique Constraint
            $table->unique(['sender_id', 'sender_type', 'receiver_id', 'receiver_type'], 'conv_sender_receiver_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
