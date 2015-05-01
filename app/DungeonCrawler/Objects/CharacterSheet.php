<?php namespace DungeonCrawler\Objects;

use DungeonCrawler\Objects\CharacterHP;
use DungeonCrawler\Objects\Helpers\Character;

class CharacterSheet extends \Eloquent {

    protected $table = 'character_sheets';

    protected $guarded = array('id', 'sheet_id');

    /************************************************************************
     * Scopes
     ***********************************************************************/

    public function scopeAll($query)
    {
        return $query->with('CharacterGeneral', 'CharacterHP');
    }

    /************************************************************************
     * Relations
     ***********************************************************************/

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

            $charSheet->abilities = array(
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0
            );
            $charSheet->save();
        });
    }


    /************************************************************************
     * Accessors and Mutators
     ***********************************************************************/

    public function getAbilitiesAttribute($abilities)
    {
        return unserialize($abilities);
    }

    public function setAbilitiesAttribute($prof)
    {
        $this->attributes['abilities'] = serialize($prof);
    }
}