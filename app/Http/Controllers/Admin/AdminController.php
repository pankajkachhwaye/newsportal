<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\Language;
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
        $laguages = Language::all()->toArray();
        return view('admin.languageform',compact('laguages'));
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
        $laguages = Language::all()->toArray();
        return view('admin.newsadd',compact('laguages'));
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
}
