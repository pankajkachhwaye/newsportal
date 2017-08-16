<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;

class ApiPanelController extends Controller
{
    //
    public function index()
    {
        return view('APIs.allapi');
    }

    public function registerForm(){
        return view('APIs.registeruser');
    }

    public function loginForm(){
        return view('APIs.loginuser');
    }

    public function categories()

    {
        return view('APIs.categories');
    }
    public function subcategories()
    {

        $data=Categories::all()->toArray();
        return view('APIs.subcategories', compact('data'));

    }

    public function news()
    {
        $data=Categories::all()->toArray();
        return view('APIs.news' ,compact('data'));

    }



}

