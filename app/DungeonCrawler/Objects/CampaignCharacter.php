<?php namespace DungeonCrawler\Objects;

class CampaignCharacter extends \Eloquent{

    protected $table = 'campaign_characters';

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'camp_id', 'id');
    }
    public function CharacterSheet()
    {
        return $this->hasOne('DungeonCrawler\Objects\CharacterSheet', 'id', 'sheet_id');
    }
}