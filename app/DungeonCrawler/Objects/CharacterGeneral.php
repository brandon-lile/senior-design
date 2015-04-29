<?php namespace DungeonCrawler\Objects;

use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\CharacterHP;
use DungeonCrawler\Objects\Helpers\SpellClass;

use Illuminate\Support\Facades\Validator;

class CharacterGeneral extends \Eloquent {

    protected $table = 'character_generals';

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }

    /*************************************************************************
     * Validation
     ************************************************************************/

    protected static $rules_create = array(
        'char_name' => 'required',
        'race' => 'required|integer',
        'class' => 'required|integer',
        'level' => 'required|integer',
        'background' => 'required|integer',
        'xp' => 'required|integer',
        'alignment' => 'required|integer'
    );

    protected $errors;

    public function isValid($create = false)
    {
        $validation = Validator::make($this->attributes, ($create ? static::$rules_create : false));

        if($validation->passes())
        {
            return true;
        }

        $this->errors = $validation->messages();
        return false;
    }

    public function getValidatorErrors()
    {
        return $this->errors;
    }

    /*************************************************************************
     * Helpers
     ************************************************************************/

    protected $races = array(
        0 => 'Human',
        1 => 'Elf',
        2 => 'Dwarf',
        3 => 'Halfling',
        4 => 'Gnome',
        5 => 'Half-Orc',
        6 => 'Dragonborn',
        7 => 'Half-elf',
        8 => 'Tiefling'
    );

    protected $alignments = array(
        0 => 'Lawful Good',
        1 => 'Neutral Good',
        2 => 'Chaotic Good',
        3 => 'Lawful Neutral',
        4 => 'Neutral Neutral',
        5 => 'Chaotic Neutral',
        6 => 'Lawful Evil',
        7 => 'Neutral Evil',
        8 => 'Chaotic Evil'
    );

    protected $backgrounds = array(
        1 => 'Acolyte',
        2 => 'Charlatan',
        3 => 'Criminal',
        4 => 'Entertainer',
        5 => 'Folk Hero',
        6 => 'Guild Artisan',
        7 => 'Hermit',
        8 => 'Noble',
        9 => 'Outlander',
        10 => 'Sage',
        11 => 'Sailor',
        12 => 'Soldier',
        13 => 'Urchin'
    );

    protected $classes = array(
        0 => 'Fighter',
        1 => 'Wizard',
        2 => 'Cleric',
        3 => 'Rogue',
        4 => 'Ranger'
    );

    public function raceToDropdown()
    {
        return $this->races;
    }

    public function alignmentToDropdown()
    {
        return $this->alignments;
    }

    public function backgroundToDropdown()
    {
        return $this->backgrounds;
    }

    public function classToDropdown()
    {
        $tmpClasses = SpellClass::orderBy('class', 'ASC')->get();
        $classes = array();
        foreach ($tmpClasses as $class)
        {
            $classes[$class->id] = $class->class;
        }
      return $classes;
    }
}