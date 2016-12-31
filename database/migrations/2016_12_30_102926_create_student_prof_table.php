<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentProf', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('student_id');

            $table->unique('student_id');

            $table->foreign("teacher_id")->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign("student_id")->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentProf');
    }
}
