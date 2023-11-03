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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('r_id');
            $table->unsignedBigInteger('p_id');
            $table->boolean('r_status');
            $table->string('r_file')->nullable();
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
        Schema::dropIfExists('reports');
    }
};