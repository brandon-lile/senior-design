<?php namespace DungeonCrawler\Objects;

class DiaryEntry extends \Eloquent {

    protected $table = 'diary_entrys';

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'camp_id', 'id');
    }
}