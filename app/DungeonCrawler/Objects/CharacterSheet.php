<?php namespace DungeonCrawler\Objects;

class CharacterSheet extends \Eloquent {

    protected $table = 'character_sheets';

    protected $guarded = array('id', 'sheet_id');

    public function User()
    {
        return $this->belongsTo('DungeonCrawler\User', 'user_id', 'id');
    }
 
}