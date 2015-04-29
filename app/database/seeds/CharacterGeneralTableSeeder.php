<?php
use DungeonCrawler\Objects\CharacterGeneral;

class CharacterGeneralTableSeeder extends Seeder {

    public function run(){

        DB::table('character_generals')->delete();
        CharacterGeneral::create(
            array(
                'sheet_id' => intval(1),
                'char_name'=>'lucy',
                'race'=>intval(1),
                'class'=>intval(2),
                'level'=>intval(0),
                'background'=>intval(3),
                'alignment'=>intval(1),
                'age'=>intval(80),
                'height'=>intval(69),
                'weight'=>intval(150),
                'eyes'=>'blue',
                'skin'=>'ivory',
                'xp'=>intval(12000)
            )
        );

    }
}