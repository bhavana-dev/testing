<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function loadView(){
    	return view('maps/map_view');
    }
}
