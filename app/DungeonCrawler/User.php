<?php namespace DungeonCrawler;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Validator;

class User extends \Eloquent implements UserInterface, RemindableInterface{

    use UserTrait, RemindableTrait;

    protected $table = 'users';

    protected $hiden = array('password', 'remember_token');

    protected $guarded = array('id', 'csrf_token');

    protected static $rules_register = array(
        'email' => 'required|email|unique:users',
        'username' => 'required|min:6|unique:users',
        'password' => 'required|min:8',
        'password_confirm' => 'required|same:password'
    );

    protected $errors;

    public function CharacterSheets()
    {
        return $this->hasMany('DungeonCrawler\Objects\CharacterSheet');
    }

    public function CharacterGenerals()
    {
        return $this->hasManyThrough('DungeonCrawler\Objects\CharacterGeneral', 'DungeonCrawler\Objects\CharacterSheet', 'user_id', 'sheet_id');
    }

    public function CampaignCharacters()
    {
        return $this->hasManyThrough('DungeonCrawler\Objects\CampaignCharacter', 'DungeonCrawler\Objects\CharacterSheet', 'user_id', 'sheet_id');
    }

    public function OwnedCampaigns()
    {
        return $this->hasMany('DungeonCrawler\Objects\Campaign', 'dm_id', 'id');
    }

    public function PendingPlayer()
    {
        return $this->hasMany('DungeonCrawler\Objects\PendingPlayer');
    }

    public function getValidatorErrors()
    {
        return $this->errors;
    }

    public function getPrettyValidatorErrors()
    {
        $output_string = "The following errors were encountered:<br><ul class='ui list'>";

        foreach($this->errors->all() as $error)
        {
            $output_string .= "<li>" . $error . "</li>";
        }

        $output_string .= "</li>";

        return $output_string;
    }

    public function isValid($register = false)
    {
        $validation = Validator::make($this->attributes, ($register ? static::$rules_register : false));

        if($validation->passes())
        {
            return true;
        }

        $this->errors = $validation->messages();

        return false;
    }
}