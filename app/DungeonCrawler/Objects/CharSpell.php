<?php namespace DungeonCrawler\Objects;

class CharSpell extends \Eloquent {

    protected $table = 'char_spells';

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }

    public function Spell()
    {
         return $this->hasOne('DungeonCrawler\Objects\Spell', 'id', 'spell_id');
    }
}
