<?php

use Illuminate\View\Factory as View;

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
        $this->layout->content = $this->view->make('pages.home.index');
    }

}