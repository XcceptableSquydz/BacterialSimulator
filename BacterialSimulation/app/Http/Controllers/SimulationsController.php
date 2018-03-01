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
    	$pathogens = Pathogen::all();
    	$foods = Food::all();
    	return view('simulations', ['pathogens' => $pathogens,
    		'foods' => $foods]);
    }
}
