<?php namespace DungeonCrawler\Objects;


class SpellsUsed extends \Eloquent {

    protected $table = 'spells_used';

    public $timestamps = false;

    protected $guarded = array('');

    public function CharacterSheet()
    {
        return $this->hasOne('DungeonCrawler\Objects\CharacterSheet', 'id', 'sheet_id');
    }

    public function getSpellsUsedAttribute($value)
    {
        return unserialize($value);
    }

    public function setSpellsUsedAttribute($value)
    {
        $this->attributes['spells_used'] = serialize($value);
    }
}