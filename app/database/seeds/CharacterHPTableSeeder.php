<?php
use DungeonCrawler\Objects\CharacterGeneral;

class CharacterHPTableSeeder extends Seeder {

    public function run(){

        DB::table('character_hps')->delete();
        CharacterGeneral::create(
            array(
                'max'=>intval(168),
                'current'=>intval(101),
                'temp'=>intval(168),
                'dice_total'=>intval(10),
                'dice_type'=>intval(8),
                'death_save_fails'=>intval(0),
                'death_save_success'=>intval(0)
            )
        );

    }
}