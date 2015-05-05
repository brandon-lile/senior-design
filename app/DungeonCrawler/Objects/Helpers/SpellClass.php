<?php namespace DungeonCrawler\Objects\Helpers;


class SpellClass extends \Eloquent {

    protected $table = 'spell_classes';

    protected $guarded = array('id', 'class');

    public $timestamps = false;

    public function CharacterGeneral()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterGeneral', 'id', 'class');
    }

}