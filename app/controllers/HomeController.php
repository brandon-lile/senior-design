<?php

use DungeonCrawler\User as User;

class HomeController extends BaseController {

    public $layout = 'layouts.master';

    public function showHome()
    {
        $char_sheets = User::find(1)->CharacterSheets;
        foreach($char_sheets as $sheet){
            dd($sheet);
        }
        return View::make('home');
    }

}
