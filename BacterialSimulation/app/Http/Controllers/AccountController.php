<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pathogen;
use App\Food;
use App\User;
use Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Redirect;

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
        //creating and returning variables for pathogens, foods, and admins from the database
        $pathogens = Pathogen::all();
        $foods = Food::all();
        $admins = User::all();
        return view('admin_controls', ['pathogens' => $pathogens,
            'foods' => $foods,
            'admins' => $admins]);
    }

    /**
    *post method to add a pathogen
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function addPathogen(Request $request)
    {   
        //if none of the input fields are empty, create a new pathogen, otherwise return the page with an error
        if(($request->input('pathogen-name') != '') && ($request->input('info-link') != '') && ($request->input('image-link') != '') && ($request->input('formula') != '') && ($request->input('infectious') != '')){
            Pathogen::create([
                'pathogen_name' => $request->input('pathogen-name'),
                'desc_link' => $request->input('info-link'),
                'image' => $request->input('image-link'),
                'formula' => $request->input('formula'),
                'infectious_dose' => $request->input('infectious')
            ]);
        }
        else
        {
            return Redirect::back()->withErrors(['The entire form must be filled out', 'The pathogen was not added to the database.']);
        }
        return Redirect::to('/admin_controls');
    }

    /**
    *post method to add a food
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function addFood(Request $request)
    {
        //if none of the input fields are empty, create a new food, otherwise return the page with an error
        if(($request->input('food-name') != '') && ($request->input('cooked') != '') && ($request->input('water-content') != '') && ($request->input('ph') != '') && ($request->input('image-link') != '')){
            Food::create([
                'food_name' => $request->input('food-name'),
                'cooked' => $request->input('cooked'),
                'available_water' => $request->input('water-content'),
                'ph_level' => $request->input('ph'),
                'image_link' => $request->input('image-link')
            ]);
        }
        else{
            return Redirect::back()->withErrors(['The entire form must be filled out', 'The food was not added to the database.']);
        }
        return Redirect::to('/admin_controls');
    }

    /**
    *post method to promote a user to admin
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function promote(Request $request)
    {
        //get the email from the form and set the user level to 1 (which is co-admin), then redirect back to the page
        $email = $request->input('email');
        if ($email != ''){
            $user = User::where('email', $email) -> first();
            $user->user_level = 1;
            $user->save();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['No email address entered', 'The account has not been updated. Please double check the email address.']);
        }
        
    }

    /**
    *post method to demote a user to admin
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function demote(Request $request)
    {
        //get the email from the form and set the user level to 1 (which is co-admin), then redirect back to the page
        $email = $request->input('email');
        if ($email != ''){
            $user = User::where('email', $email) -> first();
            $user->user_level = 0;
            $user->save();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['No email address entered', 'The account has not been updated. Please double check the email address.']);
        }
    }

    /**
    *post method to delete a food from the database
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function deleteFood(Request $request)
    {
        //get the food from the form and delete it from the database
        $food_name = $request->get('delete-food');
        
        if ($food_name != ''){
            Food::where('food_name', $food_name) -> delete();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['Something went wrong', 'Food not deleted.']);
        }
    }

    /**
    *post method to delete a pathogen from the database
    *
    * @return \Illuminate\Http\Response
    *
    */
    public function deletePathogen(Request $request)
    {
        //get the pathogen from the form and delete it from the database
        $pathogen_name = $request->input('delete-pathogen');
        if ($pathogen_name != ''){
            Pathogen::where('pathogen_name', $pathogen_name) -> delete();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['Something went wrong', 'Pathogen not deleted.']);
        }
    }

    public function editFood(Request $request)
    {
        //get the food from the form and delete it from the database
        //if none of the input fields are empty, create a new food, otherwise return the page with an error
        $food_name = $request->get('select-food');
        if(($food_name != '') && ($request->input('new-food-name') != '') && ($request->input('new-cooked') != '') && ($request->input('new-water-content') != '') && ($request->input('new-ph') != '')){
            Food::where('food_name', $food_name) -> update([
                'food_name' => $request->input('new-food-name'),
                'cooked' => $request->input('new-cooked'),
                'available_water' => $request->input('new-water-content'),
                'ph_level' => $request->input('new-ph')
            ]);
        }
        else{
            return Redirect::back()->withErrors(['The entire form must be filled out', 'The food was not updated in the database.']);
        }
        return Redirect::to('/admin_controls');
    }
    public function editPathogen(Request $request)
    {
        //get the food from the form and delete it from the database
        //if none of the input fields are empty, create a new food, otherwise return the page with an error
        $pathogen_name = $request->get('select-pathogen');
        if(($pathogen_name != '') && ($request->input('new-pathogen-name') != '') && ($request->input('new-info-link') != '') && ($request->input('new-image-link') != '') && ($request->input('new-formula') != '')){
            Pathogen::where('pathogen_name', $pathogen_name) -> update([
                'pathogen_name' => $request->input('new-pathogen-name'),
                'desc_link' => $request->input('new-info-link'),
                'image' => $request->input('new-image-link'),
                'formula' => $request->input('new-formula')
            ]);
        }
        else{
            return Redirect::back()->withErrors(['The entire form must be filled out', 'The pathogen was not updated in the database.']);
        }
        return Redirect::to('/admin_controls');
    }

}
