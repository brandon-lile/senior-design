<?php

use DungeonCrawler\Objects\CharSpell;

class CharSpellTableSeeder extends Seeder {

    public function run()
    {

        DB::table('char_spells')->delete();

        CharSpell::create(
            array(
                'sheet_id' => intval(1),
                'spell_id' => intval(1),
                'prepared' => true,
            )
        );
    }
}