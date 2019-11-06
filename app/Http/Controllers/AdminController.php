<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(){
    	//dd($this->middleware('adminis'));die();
    	$this->middleware('adminis');
    }

    public function index(){
    	echo "you are an administrator";
    }
}
