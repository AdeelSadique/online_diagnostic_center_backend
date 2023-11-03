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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('p_id');
            $table->string('name',50);
            $table->string('email',100)->unique();
            $table->char('p_contact',11);
            $table->char('p_blood')->nullable();
            $table->char('p_gender',1);
            $table->date('p_dob');
            $table->char('user_type');
            $table->text('p_address',100);
            $table->string('p_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
