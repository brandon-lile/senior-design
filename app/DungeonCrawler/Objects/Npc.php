<?php namespace DungeonCrawler\Objects;

use Illuminate\Support\Facades\File;

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

    public static function boot()
    {
        parent::boot();

        Npc::deleted(function($npc)
        {
            if (File::isFile(public_path('images/uploads/' . $npc['npc_pic'] . "." . $npc['npc_pic_ext'])))
            {
                File::delete(public_path('images/uploads/' . $npc['npc_pic'] . "." . $npc['npc_pic_ext']));
            }
        });
    }
}