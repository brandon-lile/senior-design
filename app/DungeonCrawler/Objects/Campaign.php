<?php namespace DungeonCrawler\Objects;

class Campaign extends \Eloquent {

    protected $table = 'campaigns';

    protected $guarded = array('id', 'dm_id');

    public function User()
    {
        return $this->belongsTo('DungeonCrawler\User', 'user_id', 'id');
    }
}