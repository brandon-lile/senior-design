<?php namespace DungeonCrawler\Objects;

use DungeonCrawler\Objects\Helpers\SpellClass as SpellClass;

class Spell extends \Eloquent {

    protected $table = 'spells';

    protected $guarded = array('id');

    public $timestamps = false;

    public function getClassAttribute($value)
    {
        if(is_numeric($value))
        {
            $class = SpellClass::find(intval($value));
            return $class->class;
        }
        else
        {
            return $value;
        }
    }
}