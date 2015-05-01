<?php

use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector as Redirect;

class HomeController extends BaseController {

    public $layout = 'layouts.general';

    private $view;

    public function __construct(View $view)
    {
        parent::__construct();

        $this->view = $view;
    }

    public function showHome()
    {
        if (\Auth::user() != null)
        {
            return \Redirect::to('dashboard');
        }

        $this->layout->content = $this->view->make('pages.home.index');
    }

}