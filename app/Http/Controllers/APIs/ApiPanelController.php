<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPanelController extends Controller
{
    //
    public function index()
    {
        return view('APIs.panel');
    }
}
