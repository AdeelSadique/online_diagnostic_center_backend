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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('a_id');
            $table->string('name',50);
            $table->string('email',100)->unique();
            $table->char('a_contact',11);
            $table->char('a_gender',1);
            $table->date('a_dob');
            $table->char('user_type');
            $table->text('a_address',100);
            $table->string('a_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
