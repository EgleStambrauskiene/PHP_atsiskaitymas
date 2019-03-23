<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory('App\Lecture', 1)->create();
        // factory('App\Student', 1)->create();
        factory('App\Grade', 9)->create();
        factory('App\User', 3)->create();
    }
}
