<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('gender');
            $table->text('address');
            $table->integer('age');
            $table->string('year_level');
            $table->string('course');
            $table->string('first_sem')->default('not enrolled');
            $table->string('second_sem')->default('not enrolled');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};