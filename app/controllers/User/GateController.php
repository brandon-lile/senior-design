<?php namespace User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\Support\Facades\Session;

use DungeonCrawler\User as User;

class GateController extends \BaseController {

    protected $layout = 'layouts.general';

    private $view;

    private $redirect;

    private $user;

    public function __construct(View $view, Redirect $redirect, User $user)
    {
        parent::__construct();

        $this->view = $view;
        $this->redirect = $redirect;
        $this->user = $user;
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
        $register_user = new User();
        $register_user->fill(Input::all());

        if ($register_user->isValid(true))
        {
            $this->user->fill(Input::except(array('password', 'password_confirm')));
            $this->user->password = \Hash::make(Input::get('password'));
            $this->user->save();

            return $this->redirect->to('login');
        }
        else
        {
            Session::flash('flash_message', array(
                'header' => 'Registration Failed',
                'type' => 'red',
                'close' => true,
                'body' => $this->user->getPrettyValidatorErrors()
            ));

            $this->layout->content = $this->view->make('pages.register.index');
        }
    }

}