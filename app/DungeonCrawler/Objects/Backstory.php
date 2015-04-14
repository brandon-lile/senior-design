<?php namespace DungeonCrawler\Objects;

class Backstory extends \Eloquent {

    protected $table = 'backstorys';

    protected $guarded = array('sheet_id');

     public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'sheet_id');
    }
}