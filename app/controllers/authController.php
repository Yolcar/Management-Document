<?php

class AuthController extends \BaseController {

    public function login(){
        return View::make('user.login');
    }

    public function handleLogin(){
        $data = Input::only(['email', 'password']);

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user = Auth::User();
            $user->last_session = Session::getId();
            $user->save();
            return Redirect::to('/');
        }
        return Redirect::route('login')->withInput();
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }

}