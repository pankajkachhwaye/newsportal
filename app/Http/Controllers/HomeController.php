<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_count = AppUser::all()->count();
        $news_count = News::all()->count();
        $language_count = Language::all()->count();
        $categories_count = Category::all()->count();


        return view('dashboard',compact('user_count','news_count','categories_count','language_count'));
    }
}
