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
        Schema::create('tests', function (Blueprint $table) {
            $table->id('t_id');
            $table->string('t_name',50);
            $table->string('t_category',50);
            $table->string('t_price');
            $table->boolean('t_status')->default(1);

            $table->string('t_location',50);
            $table->string('reporting_time',20);

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
        Schema::dropIfExists('tests');
    }
};