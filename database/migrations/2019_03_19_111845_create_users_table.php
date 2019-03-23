<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loginname');
            $table->string('email');
           // We don't implement email verification
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            // We don't implement remember me functionality
            // $table->rememberToken();
            // We don't implement created_at updated_at
            // $table->timestamps();
            // Indexes
            $table->unique('loginname');
            $table->unique('email');
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
        Schema::dropIfExists('users');
    }
}
