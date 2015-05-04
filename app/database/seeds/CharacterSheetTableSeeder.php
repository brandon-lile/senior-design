<?php

use DungeonCrawler\Objects\CharacterSheet;

class CharacterSheetTableSeeder extends Seeder {

    public function run()
    {
        DB::table('character_sheets')->delete();
        $statement = "ALTER TABLE character_sheets AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        CharacterSheet::create(
            array(
                'user_id' => intval(1),
                'abilities' => serialize(
                    array(
                        0 => intval(1),
                        1 => intval(0),
                        2 => intval(3),
                        3 => intval(4),
                        4 => intval(5),
                        5 => intval(6)
                    )
                ),
                'insp' => intval(1),
                'armor_class' => intval(1),
                'initiative' => intval(3),
                'speed' => intval(120),
                'proficiencies' => serialize(
                    array(
                        0 => intval(1),
                        1 => intval(0),
                    )
                ),
                'attack_spell_notes' => "This is the default attack spell notes",
                'features' => "No features to be found here"
            )
        );
    }
}