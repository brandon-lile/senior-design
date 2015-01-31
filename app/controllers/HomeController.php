<?php

class HomeController extends BaseController {

    public $layout = 'layouts.master';

	public function showHome()
	{
		return View::make('home');
	}

}
