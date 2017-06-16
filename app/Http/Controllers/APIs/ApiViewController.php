<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiViewController extends Controller
{
    //

    public function test()
    {

        return view('APIs.test');
    }
}
