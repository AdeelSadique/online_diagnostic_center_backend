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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('r_id');
            $table->string('rating');
            $table->unsignedBigInteger('t_id');
            $table->foreign('t_id')->references('t_id')->on('tests');
            $table->unsignedBigInteger('p_id');
            $table->foreign('p_id')->references('p_id')->on('patients');
            $table->unsignedBigInteger('ap_id');
            $table->foreign('ap_id')->references('ap_id')->on('appointments');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};