<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id('b_id');
            $table->boolean('b_status');
            $table->string('b_amount');
            $table->unsignedBigInteger('ap_id');
            $table->foreign('ap_id')->references('ap_id')->on('appointments');
            $table->unsignedBigInteger('m_id');
            $table->foreign('m_id')->references('m_id')->on('managers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};