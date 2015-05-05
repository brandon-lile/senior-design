<?php

use DungeonCrawler\Objects\Spell as Spell;
use DungeonCrawler\Objects\Helpers\SpellClass as SpellClass;

class SpellsTableSeeder extends CSVSeeder {

    public function run()
    {
        Eloquent::unguard();

        // Delete the table (once)
        DB::table('spells')->delete();
        $statement = "ALTER TABLE spells AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        // Seed the spells
        $this->SeedFromCSV('spells', 'warlock.csv');
        $this->SeedFromCSV('spells', 'ranger.csv');
        $this->SeedFromCSV('spells', 'paladin.csv');
        $this->SeedFromCSV('spells', 'druid.csv');
        $this->SeedFromCSV('spells', 'cleric.csv');
        $this->SeedFromCSV('spells', 'bard.csv');
        $this->SeedFromCSV('spells', 'sorcerer.csv');
        $this->SeedFromCSV('spells', 'wizard.csv');

        DB::table('spell_classes')->delete();
        $statement = "ALTER TABLE spell_classes AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        $spells = Spell::all();
        $classes = array();
        $directory = array();
        $id = 1;
        foreach($spells as $spell)
        {
            if(!in_array($spell->class, $directory))
            {
                $directory[] = $spell->class;
                $classes[] = array(
                    'id' => $id,
                    'class' => $spell->class
                );
                $id++;
            }
        }

        $extra_classes = array(
            'Rogue', 'Rogue (Thief)', 'Rogue (Assassin)', 'Rogue (Arcane Trickster)',
            'Fighter', 'Fighter (Champion)', 'Fighter (Battle Master)', 'Fighter (Eldritch Knight)',
            'Barbarian', 'Barbarian (Berserker)', 'Barbarian (Totem Warrior)',
            'Monks', 'Monk (Open Hand)', 'Monk (Shadow)', 'Monk (Four Elements)',
            'Ranger (Hunter)', 'Ranger (Beast Master)'
        );
        foreach($extra_classes as $class)
        {
            $classes[] = array(
                'id' => $id,
                'class' => $class
            );
            $id++;
        }

        DB::table('spell_classes')->insert($classes);

        // Rename class field and add class id field
        $statement = "ALTER TABLE spells CHANGE class class_string varchar(255)";
        DB::unprepared($statement);
        $statement = "ALTER TABLE spells ADD class tinyint(4)";
        DB::unprepared($statement);

        // Fill in class id field with proper spell_class
        $spells = Spell::all();
        foreach($spells as $spell)
        {
            $spell_id = SpellClass::where('class', $spell->class_string)->first();
            $spell->class = $spell_id->id;
            $spell->save();
        }

        $statement = "ALTER TABLE spells DROP class_string";
        DB::unprepared($statement);
    }
}