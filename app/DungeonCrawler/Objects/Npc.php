<?php namespace DungeonCrawler\Objects;

class Npc extends \Eloquent {

    protected $table = 'npcs';

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'camp_id', 'id');
    }
}