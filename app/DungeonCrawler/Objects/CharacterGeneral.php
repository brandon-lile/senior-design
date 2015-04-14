<?php namespace DungeonCrawler\Objects;
/**
 * Created by PhpStorm.
 * User: Holly
 * Date: 4/13/2015
 * Time: 7:13 PM
 */
class CharacterGeneral extends \Eloquent {

    protected $table = 'character_general';

    protected $guarded = array('id');

    public function characterSheet()
    {
        return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
    }
}