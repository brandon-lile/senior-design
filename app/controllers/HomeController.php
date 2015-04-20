<?php

use DungeonCrawler\User as User;
use DungeonCrawler\Objects\Spell as Spell;

class HomeController extends BaseController {

    public $layout = 'layouts.master';

    public function showHome()
    {

        $spells = Spell::all();
        $classes = array();
        foreach($spells as $spell) {
            $classes[] = $spell->class;
        }
        dd($classes);

        $char_sheets = User::find(1)->CharacterSheets;
        foreach($char_sheets as $sheet){
            dd($sheet);
        }
        return View::make('home');
    }

}
