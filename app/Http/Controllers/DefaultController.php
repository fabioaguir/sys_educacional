<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use SerEducacional\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('default.index');
    }
}
