<?php namespace DungeonCrawler\Objects;


class Equipment extends \Eloquent {

    protected $table = 'equipment';

    public $timestamps = false;

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Equipment', 'sheet_id', 'id');
    }
}