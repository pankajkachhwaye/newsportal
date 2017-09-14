<?php

namespace App\Http\Controllers\APIs;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\Models\Language;
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

    public function showCategoryForm(){
        $laguages = Language::all()->toArray();
        return view('APIs.categoriesform',compact('laguages'));
    }

    public function news()
    {
        $data=Categories::all()->toArray();

        return view('APIs.news' ,compact('data'));

    }

    public function showNewsForm(){
        $categories = Category::all()->toArray();
        $laguages = Language::all()->toArray();
        return view('APIs.newsform',compact('categories','laguages'));
    }

    public function showRelatedNewsForm(){
        $categories = Category::all()->toArray();
        $laguages = Language::all()->toArray();
        return view('APIs.relatednews',compact('categories','laguages'));
    }


    public function showLikeNewsForm(){
        $news = News::all()->toArray();
        return view('APIs.likenewsform',compact('news'));
    }

    public function showAddFavrouiteNewsForm(){
        $news = News::all()->toArray();
        return view('APIs.addfavourite',compact('news'));
    }

    public function showGetFavrouiteNewsForm(){
        return view('APIs.getfavourite' );
    }

    public function showGetAllNotificationsForm(){
        return view('APIs.getnotification');
    }

    public function showForgoFasswordForm(){
        return view('APIs.forgotpassword' );
    }

    public function showAllLanguagesForm(){
        return view('APIs.alllanguaugeform' );
    }

    public function showSearchNewsForm(){
        return view('APIs.searchform' );
    }

    public function showLogoutForm(){
        return view('APIs.logout' );
    }

}

