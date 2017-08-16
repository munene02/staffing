<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Site;
use App\Client;

class SitesController extends Controller
{
    public function show()   
    {
    	
		$sites = Site::all();
		return view('sites.show', compact('sites'));

    }
}
