<?php namespace DungeonCrawler\Objects;

class CharacterHP extends \Eloquent {

    protected $table = 'character_hps';

    protected $guarded = array('id');

    public function characterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}