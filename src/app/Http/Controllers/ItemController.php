<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(request $request) 
    {
        return view('/index');
    }
}
