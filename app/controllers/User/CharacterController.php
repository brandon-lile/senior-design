<?php namespace User;

use Illuminate\View\Factory as View;
use DungeonCrawler\Objects\CharacterGeneral;

class CharacterController extends \BaseController{

    public $layout = 'layouts.index';

    private $view;

    private $characterGeneral;

    public function __construct(View $view, CharacterGeneral $characterGeneral)
    {
        parent::__construct();

        $this->view = $view;
        $this->characterGeneral = $characterGeneral;
    }

    public function getIndex()
    {
        $this->layout->content = $this->view->make('pages.character.sheet')
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown());
    }
}