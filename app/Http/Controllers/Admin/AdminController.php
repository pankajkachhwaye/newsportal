<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\Language;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Response;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLanguageForm(){
        $page = 'language';
        $laguages = Language::all()->toArray();
        return view('admin.languageform',compact('laguages','page'));
    }

    public function postLanguage(Request $request,CrudRepository $repo){
        $save =$repo->createNew($request->all(), new Language());
        if($save['code'] == 101){
            $locations = Language::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Language Added Successfully')->with($locations);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }

    public function addNewsForm(){
        $page = 'news';
        $sub_page = 'news-add';
        $laguages = Language::all()->toArray();
        return view('admin.newsadd',compact('laguages','page','sub_page'));
    }

    public function categoryByLang($id){
        $temp_categories = Category::GetCategoryByLang($id)->get();
        if($temp_categories->count() > 0){
            $categories =   $temp_categories->toArray();
            $categoriesArray = [];
            foreach ($categories as $key_cate => $value_cate){
                $value_cate['category_icon'] =   asset('storage/'.$value_cate['category_icon']);
                array_push($categoriesArray,$value_cate);
            }
            return Response::json(['code' => 200, 'status' => true,'message' => 'Data Found.','data' =>$categoriesArray]);
        }
        else{
            return Response::json(['code' => 500, 'status' => true,'message' => 'No category found in this language.','data' =>array()]);
        }
    }

    public function postNews(Request $request, CrudRepository $repo){
        $save =$repo->addNews($request->all());
        if($save['code'] == 101){
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }

    public function showNews(){
        $page = 'news';
        $sub_page = 'news-show';
        $temp_news = News::all();
        $news = [];
        foreach ($temp_news as $key_news => $value_news){
            $category = $value_news->category->first(['category_name']);
            $x =$value_news->toArray();
            $x['category_name'] = $category->category_name;
            unset($x['category']);
            array_push($news,$x);
        }
//        dd($news);
        return view('shownews',compact('news','page','sub_page'));
    }

    public function deleteNews($id){
        $news = News::find($id);
        $news->delete();
        return back()->with('returnStatus', true)->with('status', 101)->with('message','News deleted successfully');
    }
}
