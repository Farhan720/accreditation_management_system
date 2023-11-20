<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('section_id');
            $table->timestamps();

        //     $table->foreign('department_id')
        //             ->references('id')
        //             ->on('subjects')
        //             ->onDelete('cascade');

        //     $table->foreign('subject_id')
        //             ->references('id')
        //             ->on('subjects')
        //             ->onDelete('cascade');

        //     $table->foreign('teacher_id')
        //             ->references('id')
        //             ->on('subjects')
        //             ->onDelete('cascade');

        //     $table->foreign('semester_id')
        //             ->references('id')
        //             ->on('subjects')
        //             ->onDelete('cascade');

        //     $table->foreign('section_id')
        //             ->references('id')
        //             ->on('subjects')
        //             ->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_subjects');
    }
}
