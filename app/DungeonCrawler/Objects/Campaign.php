<?php namespace DungeonCrawler\Objects;

use Illuminate\Support\Facades\Validator;

class Campaign extends \Eloquent {

    protected $table = 'campaigns';

    protected $guarded = array('id', 'dm_id');

    protected static $rules_create = array(
        'campaign_name' => 'required|max:150',
        'description' => 'required',
        'dm_id' => 'required'
    );

    protected $errors;

    public function scopeAll($query)
    {
        return $query->with('CharacterSheet', 'DiaryEntry', 'NPC', 'CampaignPicture');
    }

    public function isValid($create = false)
    {
        $validation = Validator::make($this->attributes, ($create ? static::$rules_create : false));

        if($validation->passes())
        {
            return true;
        }

        $this->errors = $validation->messages();

        return false;
    }

    public function getValidatorErrors()
    {
        return $this->errors;
    }

    public function DiaryEntry()
    {
        return $this->hasMany('DungeonCrawler\Objects\DiaryEntry', 'camp_id', 'id');
    }

    public function CharacterSheet()
    {
        return $this->hasManyThrough('DungeonCrawler\Objects\CharacterSheet', 'DungeonCrawler\Objects\CampaignCharacter', 'sheet_id', 'id');
    }

    public function NPC()
    {
        return $this->hasMany('DungeonCrawler\Objects\Npc', 'camp_id', 'id');
    }

    public function CampaignPicture()
    {
        return $this->hasMany('DungeonCrawler\Objects\CampaignPicture', 'camp_id', 'id');
    }
}