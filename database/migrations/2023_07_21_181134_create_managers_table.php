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
        Schema::create('managers', function (Blueprint $table) {
            $table->id('m_id');
            $table->string('name',50);
            $table->string('email',100)->unique();
            $table->char('m_contact',11);
            $table->string('hospital_name',50);
            $table->char('user_type');
            $table->text('m_address',100);
            $table->string('m_password');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};