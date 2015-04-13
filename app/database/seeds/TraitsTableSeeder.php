<?php

use DungeonCrawler\Objects\Traits;

class TraitsTableSeeder extends Seeder {

    public function run()
    {

        DB::table('traits')->delete();

        Traits::create(
            array(
                'title' => 'Dark Vision',
                'desc' => 'Seeing darkness up to 50 feet',
            )
        );
    }
}
