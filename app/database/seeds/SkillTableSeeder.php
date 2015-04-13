<?php
use DungeonCrawler\Objects\Skill;

class SkillTableSeeder extends Seeder {

    public function run(){

        DB::table('skills')->delete();
        Skill::create(
                array(
                    'value'=>intval(1),
                    'ability'=>intval(2)
                )
        );

    }
}