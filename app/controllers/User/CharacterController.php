<?php namespace User;

use Illuminate\View\Factory as View;

class CharacterController extends \BaseController{

    public $layout = 'layouts.index';

    private $view;

    public function __construct(View $view)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
    }

    public function getIndex()
    {
        $this->layout->content = $this->view->make('pages.character.sheet');
    }
}