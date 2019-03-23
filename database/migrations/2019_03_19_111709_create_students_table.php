<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 64);
            $table->string('name', 64);
            $table->string('email', 32);
            $table->string('phone', 64);
            // $table->timestamps();
            // $table->unique(['name', 'lastname', 'phone', 'email']);
            $table->unique('email');
            $table->unique('phone');
            $table->index('name');
            $table->index('lastname');
            // Engine, collation
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
        Schema::dropIfExists('students');
    }
}
