<?php

use DungeonCrawler\Objects\Treasure;

class TreasureTableSeeder extends Seeder {

    public function run()
    {
        DB::table('treasures')->delete();

        Treasure::create(
            array(
                'name' => 'Signet Ring',
                'description' => 'This is indeed a ring',
                'quantity' => intval(1)
            )
        );
    }
}