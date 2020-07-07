<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
		return view('index');
    }

    public function twinCity()
    {
    	return view('twinCity');
    }

    public function group()
    {
    	return view('group');
    }

     public function poi()
    {
    	return view('poi');
    }
}
