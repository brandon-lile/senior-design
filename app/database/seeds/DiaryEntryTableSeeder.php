<?php

use DungeonCrawler\Objects\DiaryEntry;

class DiaryEntryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('diary_entrys')->delete();

        DiaryEntry::create(
            array(
                'camp_id' => intval(1),
                'title'=>'Meeting one',
                'entry'=>'Here is a recap of our first meeting'

            )
        );
    }
}