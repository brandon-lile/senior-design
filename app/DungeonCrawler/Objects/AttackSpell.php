<?php namespace DungeonCrawler\Objects;

    class AttackSpell extends \Eloquent{
        protected $table='attackSpells';
        protected $guarded=array('id');
        public function characterSheet()
        {
            return $this->belongsTo('DungeonCrawler\Objects\CharacterSheet', 'sheet_id', 'id');
        }
    }