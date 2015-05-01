<?php namespace User;

use Illuminate\View\Factory as View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class SettingsController extends \BaseController {

    public $layout = 'layouts.index';

    private $view;

    private $request;

    private $redirect;

    private $user;

    public function __construct(View $view, Request $request, Redirect $redirect)
    {
        parent::__construct();

        $this->view = $view;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->user = \Auth::user();
    }

    public function getIndex()
    {
        $this->layout->content = $this->view->make('pages.settings.index')
                                    ->with('user', $this->user);
    }

    public function postChangeUsername()
    {
        $rules = array(
            'username' => 'required|min:6|unique:users'
        );

        $validator = Validator::make($this->request->all(), $rules);

        if ($validator->fails())
        {
            return $this->redirect->action('User\SettingsController@getIndex')->withErrors($validator);
        }
        else
        {
            $this->user->username = $this->request->get('username');
            $this->user->save();

            Session::flash('flash_message', array(
                'header' => 'Username Changed Successfully',
                'type' => 'green',
                'close' => true,
                'body' => 'You successfully changed your username!'
            ));

            return $this->redirect->action('User\SettingsController@getIndex');
        }
    }

    public function postChangeEmail()
    {
        $rules = array(
            'email' => 'required|email|unique:users'
        );

        $validator = Validator::make($this->request->all(), $rules);

        if ($validator->fails())
        {
            return $this->redirect->action('User\SettingsController@getIndex')->withErrors($validator);
        }
        else
        {
            $this->user->email = $this->request->get('email');
            $this->user->save();

            Session::flash('flash_message', array(
                'header' => 'Password Change Success',
                'type' => 'green',
                'close' => true,
                'body' => 'You successfully changed your email!'
            ));

            return $this->redirect->action('User\SettingsController@getIndex');
        }
    }

    public function postChangePassword()
    {
        $rules = array(
            'current_password' => 'required',
            'password' => 'required|alphaNum|min:8',
            'password_confirm' => 'required|same:password'
        );

        $validator = Validator::make($this->request->all(), $rules);

        if ($validator->fails())
        {
            return $this->redirect->action('User\SettingsController@getIndex')->withErrors($validator);
        }
        else
        {
            if (!\Hash::check($this->request->get('current_password'), $this->user->password))
            {
                return $this->redirect->action('User\SettingsController@getIndex')->withErrors('Your current password was incorrect');
            }
            else
            {
                $this->user->password = \Hash::make($this->request->get('password'));
                $this->user->save();

                Session::flash('flash_message', array(
                    'header' => 'Password Change Success',
                    'type' => 'green',
                    'close' => true,
                    'body' => 'You successfully changed your password!'
                ));

                return $this->redirect->action('User\SettingsController@getIndex');
            }
        }
    }
}