<?php namespace DungeonCrawler\Objects;


class CampaignPicture extends \Eloquent {

    protected $table = 'campaign_pictures';

    public $timestamps = false;

    protected $guarded = array('id');

    public function Campaign()
    {
        return $this->belongsTo('DungeonCrawler\Objects\Campaign', 'id', 'camp_id');
    }

    public function getPicFilenameAttribute($pic)
    {
        if($pic != null)
        {
            return asset('images/uploads/' . $pic . "." . $this->attributes['pic_ext']);
        }
    }
}