<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Redirect;

class EditAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('edit_account');
    }


    public function update(EditAccountController $request)
    {
        $user = Auth::user();
        if(Hash::check(Request::input('password-confirm'),$user->password)) {
            if (!Request::input('email') == ''){
                $user->email = Request::input('email');
            }
            if (!Request::input('new-password') == ''){
                $user->password = bcrypt(Request::input('new-password'));
            }
            if (!Request::input('user_type') == ''){
                $user->user_type = Request::input('user_type');
            }
            $user->save();
            return Redirect::to('/account');
        }
        else{
            return Redirect::back()->withErrors(['Incorrect Password!', 'Your account has not been updated. Please double check your password.']);
        }
    }
}
