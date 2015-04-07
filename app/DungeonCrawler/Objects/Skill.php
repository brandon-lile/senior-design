<?php namespace DungeonCrawler\Objects;

class Skill extends \Eloquent {

    protected $table = 'skills';

    protected $guarded = array('id');

    public function characterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}