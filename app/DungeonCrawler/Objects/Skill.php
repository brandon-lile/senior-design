<?php namespace DungeonCrawler\Objects;

class Skill extends \Eloquent {

    protected $table = 'skills';

    protected $guarded = array('id');

    public function characterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        Skill::creating(function($skill){
            $skill->attributes['skills'] = serialize(array(
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0,
                11 => 0,
                12 => 0,
                13 => 0,
                14 => 0,
                15 => 0,
                16 => 0,
                17 => 0,
            ));
        });
    }

    public function getSkillsAttribute($value)
    {
        return unserialize($value);
    }

    public function setSkillsAttribute($value)
    {
        $this->attributes['skills'] = serialize($value);
    }
}