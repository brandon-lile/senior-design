<?php namespace DungeonCrawler\Objects;

class CampaignCharacter extends \Eloquent{

    protected $table = 'campaign_character';

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'camp_id', 'id');
    }
    public function CharacterSheet()
    {
        return $this->hasOne('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}