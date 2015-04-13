<?php namespace DungeonCrawler\Objects;

class Traits extends \Eloquent {

    protected $table = 'traits';

    protected $guarded = array('id');

    public function characterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}
