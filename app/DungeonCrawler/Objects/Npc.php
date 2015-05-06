<?php namespace DungeonCrawler\Objects;

class NPC extends \Eloquent {

    protected $table = 'npcs';

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'camp_id', 'id');
    }

    public function getNpcPicAttribute($pic)
    {
        if($pic != null)
        {
            return asset('images/uploads/' . $pic . "." . $this->attributes['npc_pic_ext']);
        }
        else
        {
            return asset('images/avatar/stock.png');
        }
    }
}