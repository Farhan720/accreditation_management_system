<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('semester_id');
            $table->text('subject_name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

                $table->foreign('department_id')
                    ->references('id')
                    ->on('departments')
                    ->delete('cascade');

                $table->foreign('semester_id')
                    ->references('id')
                    ->on('semesters')
                    ->delete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
