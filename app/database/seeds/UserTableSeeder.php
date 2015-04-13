<?php

use DungeonCrawler\User as User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        User::create(
            array(
                'email' => 'brandon.lile@gmail.com',
                'username' => 'PyroSquirrell',
                'password' => Hash::make('password')
            )
        );
    }
}