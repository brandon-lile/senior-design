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
                        0 => intval(17),
                        1 => intval(12),
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
                'equipment' => "Ain't got nothin",
                'features' => "No features to be found here"
            )
        );
    }
}