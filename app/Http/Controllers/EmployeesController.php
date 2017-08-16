<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeesController extends Controller
{
    public function create()
    {
    	return view('employees.create');
    }
}
