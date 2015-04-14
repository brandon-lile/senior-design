<?php namespace DungeonCrawler\Objects;

class CharacterGeneral extends \Eloquent {

    protected $table = 'character_generals';

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}