<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
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
        return view('account');
    }

    /**
    *Show the admin controls view
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function adminControls()
    {
        return view('admin_controls');
    }
    /*
    Route::post('/admin_controls/pathogen', 'AccountController@addPathogen');
Route::post('/admin_controls/food', 'AccountController@addFood');
Route::post('/admin_controls/promote', 'AccountController@promote');
Route::post('/admin_controls/demote', 'AccountController@demote');
Route::post('/admin_controls/delete_pathogen', 'AccountController@deletePathogen');
Route::post('/admin_controls/delete_food', 'AccountController@deleteFood');*/

/**
    *post method to add a pathogen
    *
    * @return \Illuminate\Http\Response
    *
    */
public function addPathogen()
{
    
}

    /**
    *post method to add a food
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function addFood()
    {
        
    }

    /**
    *post method to promote a user to admin
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function promote()
    {

    }

    /**
    *post method to demote a user to admin
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function demote()
    {

    }

    /**
    *post method to delete a food from the database
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function deleteFood()
    {

    }

    /**
    *post method to delete a pathogen from the database
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function deletePathogen()
    {

    }

}
