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
        Schema::create('manager_messages', function (Blueprint $table) {
            $table->id('mm_id');
            // $table->string('name',50);
            // $table->string('email',100);
            // $table->char('contact',11);
            $table->text('message');
            $table->text('reply')->nullable();
            $table->unsignedBigInteger('p_id');
            $table->foreign('p_id')->references('p_id')->on('patients');
            $table->unsignedBigInteger('m_id');
            $table->foreign('m_id')->references('m_id')->on('tests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_messages');
    }
};
