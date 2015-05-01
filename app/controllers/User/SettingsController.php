<?php namespace User;

use Illuminate\View\Factory as View;

class SettingsController extends \BaseController {
    public $layout = 'layouts.index';

    private $view;

    public function __construct(View $view)
    {
        parent::__construct();

        $this->view = $view;
    }

    public function getIndex()
    {
        $this->layout->content = $this->view->make('pages.settings.index')
                                    ->with('user', \Auth::user());
    }

    public function postChangeUsername()
    {

    }

    public function postChangeEmail()
    {

    }

    public function postChangePassword()
    {

    }
}