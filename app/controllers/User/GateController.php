<?php namespace User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\Support\Facades\Session;

class GateController extends \BaseController {

    protected $layout = 'layouts.general';

    private $view;

    private $redirect;

    public function __construct(View $view, Redirect $redirect)
    {
        parent::__construct();

        $this->view = $view;
        $this->redirect = $redirect;
    }

    public function getLogin()
    {
        $this->layout->content = $this->view->make('pages.login.index');
    }

    public function postLogin()
    {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true))
        {
            return $this->redirect->to('dashboard');
        }
        else
        {
            Session::flash('flash_message', array(
                'header' => 'Failed Login',
                'type' => 'red',
                'close' => true,
                'body' => 'Sorry! We could not log you on with the email/password you entered'
            ));

            $this->layout->content = $this->view->make('pages.login.index');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return $this->redirect->to('login');
    }

    public function getRegister()
    {
        $this->layout->content = $this->view->make('pages.register.index');
    }

    public function postRegister()
    {

    }

}