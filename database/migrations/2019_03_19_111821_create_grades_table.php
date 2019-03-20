<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecture_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('grade')->unsigned()->nullable();
            // $table->timestamps();
            // Indexes
            $table->unique(['lecture_id', 'student_id']);
            $table->index('lecture_id');
            $table->index('student_id');
            // FK
            $table->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onUpdate('cascade')
                ->onDelete('SET NULL');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('SET NULL');
                // Engine
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_lithuanian_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
