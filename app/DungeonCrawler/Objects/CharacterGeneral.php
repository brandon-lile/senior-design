<?php namespace DungeonCrawler\Objects;

use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\CharacterHP;

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
        5 => 'Half-Orc'
    );

    protected $alignments = array(
        0 => 'Lawful Good'
    );

    protected $backgrounds = array(
        1 => 'Blacksmith',
        2 => 'Bowyer of Fletcher',
        3 => 'Brewer',
        4 => 'Calligrapher',
        5 => 'Carpenter',
        6 => 'Cartographer',
        7 => 'Cook',
        8 => 'Goldsmith/Silversmith',
        9 => 'Jeweler',
        10 => 'Painter',
        11 => 'Potter',
        12 => 'Weaver'
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
        return $this->classes;
    }
}