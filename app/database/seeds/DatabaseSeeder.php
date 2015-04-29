<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('SkillTableSeeder');
        $this->call('TraitsTableSeeder');
        $this->call('AttackSpellTableSeeder');
        $this->call('CharacterSheetTableSeeder');
        $this->call('CharSpellTableSeeder');
        $this->call('CharacterGeneralTableSeeder');
        $this->call('TreasureTableSeeder');
        $this->call('BackstoryTableSeeder');
        $this->call('SavingThrowTableSeeder');
        $this->call('SpellsTableSeeder');
        $this->call('CampaignTableSeeder');
        $this->call('CampaignCharacterTableSeeder');
    }

}
