<?php namespace DungeonCrawler\Objects;

class SavingThrow extends \Eloquent{

    protected $table = 'saving_throws';

    protected $guarded = array('id');

    public function CharacterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }

    /************************************************************************
     * Accessors and Mutators
     ***********************************************************************/

    public function getAbilitiesAttribute($value)
    {
        return unserialize($value);
    }

    public function setAbilitiesAttribute($value)
    {
        $this->attributes['abilities'] = serialize($value);
    }
}