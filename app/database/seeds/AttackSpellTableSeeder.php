<?php

use DungeonCrawler\Objects\AttackSpell;

class AttackSpellTableSeeder extends Seeder {

    public function run()
    {
        DB::table('attack_spells')->delete();

        AttackSpell::create(
            array(
                'name'=>'Fireball',
                'atk_bonus'=>intval(2),
                'dmg_type'=>'Magic',
            )
        );
    }
}