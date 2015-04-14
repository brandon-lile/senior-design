<?php

use DungeonCrawler\Objects\Backstory;

class BackstoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('backstorys')->delete();

        Backstory::create(
            array(
                'personality_traits' => 'Easily Angered',
                'ideals' => 'worships bacon',
                'bonds' => 'friendship with cats',
                'flaws' => 'none',
                'backstory' => 'Came from a distant land, far far away.',
                'notes' => 'no notes sir'
            )
        );
    }
}