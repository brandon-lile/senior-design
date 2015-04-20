<?php

use DungeonCrawler\Objects\SavingThrow;

class SavingThrowTableSeeder extends Seeder {

    public function run()
    {
        DB::table('saving_throws')->delete();

        SavingThrow::create(
            array(
                'sheet_id' => intval(1),
                'abilities' => serialize(
                    array(
                        0 => intval(0),
                        1 => intval(1),
                        2 => intval(0),
                        3 => intval(0),
                        4 => intval(1),
                        5 => intval(0)
                    )
                ),
            )
        );
    }
}