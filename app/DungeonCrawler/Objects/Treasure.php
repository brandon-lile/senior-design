<?php namespace DungeonCrawler\Objects;

class Treasure extends \Eloquent {

    protected $table = 'treasures';

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet','sheet_id','id');
    }

}