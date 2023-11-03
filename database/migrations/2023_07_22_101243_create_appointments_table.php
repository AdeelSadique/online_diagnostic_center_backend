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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('ap_id');
            $table->string('ap_type',50);
            $table->integer('ap_status');

            $table->date('ap_date');
            $table->boolean('b_status')->default(0);

            $table->unsignedBigInteger('p_id');
            $table->foreign('p_id')->references('p_id')->on('patients');
            $table->unsignedBigInteger('t_id');
            $table->foreign('t_id')->references('t_id')->on('tests');
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
        Schema::dropIfExists('appointments');
    }
};
