<?php namespace DungeonCrawler\Objects;


class PendingPlayer extends \Eloquent {

    protected $table = 'pending_players';

    public $timestamps = false;

    protected $guarded = array('id');

    public function User()
    {
        return $this->hasOne('DungeonCrawler\User', 'id', 'user_id');
    }

    public function Campaign()
    {
        return $this->hasOne('DungeonCrawler\Objects\Campaign', 'id', 'campaign_id');
    }
}