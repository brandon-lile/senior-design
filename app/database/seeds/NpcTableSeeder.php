<?php

use DungeonCrawler\Objects\Npc;

class NpcTableSeeder extends Seeder {
    public function run()
    {

        DB::table('npcs')->delete();

        Npcs::create(
            array(
                'camp_id' => intval(1),
                'name' => 'Steve',
                'desc' => "Steve is a lonely test npc that nobody wants to play with"
            )
        );
    }
}