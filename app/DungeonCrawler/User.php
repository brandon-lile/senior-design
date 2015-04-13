<?php namespace DungeonCrawler;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface{

    use UserTrait, RemindableTrait;

    protected $table = 'users';

    protected $hiden = array('password', 'remember_token');

    protected $guarded = array('id', 'csrf_token');

    public function CharacterSheets()
    {
        return $this->hasMany('DungeonCrawler\Objects\CharacterSheet');
    }
}