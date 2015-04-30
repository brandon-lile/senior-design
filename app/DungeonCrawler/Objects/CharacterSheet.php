<?php namespace DungeonCrawler\Objects;

use DungeonCrawler\Objects\CharacterHP;

class CharacterSheet extends \Eloquent {

    protected $table = 'character_sheets';

    protected $guarded = array('id', 'sheet_id');

    public function User()
    {
        return $this->belongsTo('DungeonCrawler\User', 'user_id', 'id');
    }

    public function CharacterGeneral()
    {
        return $this->hasOne('DungeonCrawler\Objects\CharacterGeneral', 'sheet_id', 'id');
    }

    public function CharacterHP()
    {
        return $this->hasOne('DungeonCrawler\Objects\CharacterHP', 'sheet_id', 'id');
    }

    public function Campaign()
    {
        return $this->hasManyThrough('DungeonCrawler\Objects\Campaign', 'DungeonCrawler\Objects\CampaignCharacter', 'sheet_id', 'id');
    }

    /************************************************************************
     * Boot Method
     ***********************************************************************/

    public static function boot()
    {
        parent::boot();

        CharacterSheet::created(function($charSheet)
        {
            $charHP = new CharacterHP();
            $charSheet->CharacterHP()->save($charHP);
        });
    }


    public function getProficienciesAttribute($prof)
    {
        $clean_array = unserialize($prof);
        $return_array = array();

        foreach($clean_array as $skill_id => $skill_val)
        {
            $return_array[] = array(
                0 => array(
                    'value' => $skill_val,
                    'modifier' => ($skill_val - 10)/2
                )
            );
        }
    }
}