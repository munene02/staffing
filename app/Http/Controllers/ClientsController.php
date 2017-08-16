<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;
use App\Site;
//use App\Employee;

class ClientsController extends Controller
{
    public function show()   
    {
    	//$clients = client::all();
    	//$clients->load('sites');

   		//return $clients;

		//$clients = client::all();
		//return view('clients.show', compact('clients'));

		
        //$clients->load('sites');
        //$clients = Client::withCount(['sites', 'employees']);

        //$clients = client::with('sites')->get();

        //$clients = Client::with()

        //$clients = client::all();

        //$count = $clients->count();

        //$sites = $clients->sites;

        //$count = $sites->count();
        //$sites = Site::all();
        //$clients = Client::with('sites.employees')->find(23)->count();
        //$sites = site::where('client_id', 1)->count();

        //$sites = Client::where('id', 1);

        //$phone = User::find(1)->phone;
        //$comments = App\Post::find(1)->comments()->where('title', 'foo')->first();

        
         $clients = Client::find(1)->sites->where('location', 'Nairobi Office');
		 return $clients;

         // $clients = Client::find(1)->sites()->orderBy('code')->get();
         // return $clients;

         // $sites = Site::find(23);
         // return $sites->employees; 

		//return view('clients.show', compact('clients'));

    }
}
