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
        Pathogen::create([
            'pathogen_name' => $request->input('pathogen-name'),
            'desc_link' => $request->input('info-link'),
            'image' => $request->input('image-link'),
            'formula' => $request->input('formula')
        ]);
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
        Food::create([
            'food_name' => $request->input('food-name'),
            'cooked' => $request->input('cooked'),
            'available_water' => $request->input('water-content'),
            'ph_level' => $request->input('ph')
        ]);
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
        $food_name = $request->get('delete-food');
        if ($food_name != ''){
            Food::where('food_name', $food_name) -> delete();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['Something went wrong', 'Pathogen not deleted.']);
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
        $pathogen_name = $request->input('delete-pathogen');
        if ($pathogen_name != ''){
            Pathogen::where('pathogen_name', $pathogen_name) -> delete();
            return Redirect::to('/admin_controls');
        }
        else {
            return Redirect::back()->withErrors(['Something went wrong', 'Pathogen not deleted.']);
        }
    }

}
