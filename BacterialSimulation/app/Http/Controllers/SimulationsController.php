<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pathogen;
use App\Food;
use Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Redirect;

class SimulationsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pathogen and food variables in an array from the database
    	$pathogens = Pathogen::all();
    	$foods = Food::all();
        //returning the simulations page with pathogen and food variables
    	return view('simulations', ['pathogens' => $pathogens,
    		'foods' => $foods]);
    }
}
