<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $users =\App\User::paginate(2);
        return view('home',compact('users'));
    }

    public function createForm(){
        return view('form');
    }

    public function GetDirection(Request $request){
        $destination = $request->input('destination');

        return view('maps/direction',compact('destination'));
    }

    //(Bhavana )testing function
    public function test(){
        
        return view('maps/test_area');
        
    }

    public function Javascript(){

    }
}
