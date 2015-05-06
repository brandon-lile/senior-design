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

        if(App::environment() != "production"){
            $this->call('UserTableSeeder');
            $this->call('TraitsTableSeeder');
            $this->call('AttackSpellTableSeeder');
            $this->call('CharacterSheetTableSeeder');
            $this->call('CharSpellTableSeeder');
            $this->call('CharacterGeneralTableSeeder');
            $this->call('TreasureTableSeeder');
            $this->call('BackstoryTableSeeder');
            $this->call('CampaignTableSeeder');
            $this->call('CampaignCharacterTableSeeder');
            $this->call('DiaryEntryTableSeeder');
        }
        $this->call('SpellsTableSeeder');
    }

}
