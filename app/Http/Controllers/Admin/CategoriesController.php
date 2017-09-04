<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Categories;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {
        $laguages = Language::all()->toArray();
        return view('admin.categories',compact('laguages'));
    }
    public function store(Request $request)
    {

        $categorie=new Category();

        $categorie->category_name= $request->category_name;
        $categorie->language_id= $request->language_id;

        $categories_image= $request->category_icon;
        $ext = $categories_image->getClientOriginalExtension();
        $path= Storage::putFileAs('categories', $categories_image, time().$categorie->category_icon.".".$ext);('');
        $categorie->category_icon=$path;
        $categorie->save();
        return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Category Added successfully');



    }
    public function show()
    {
        $data = Category::all();
        $categories = [];
        foreach ($data as $keyCate => $valueCate){
            $language = $valueCate->language;
            $x =$valueCate->toArray();
            $x['language_name'] = $language->language_name;
            unset($x['language']);
            array_push($categories,$x);
        }

        return view('showcategories',compact("categories"));
    }
    public function delete($id)
    {
        dd($id);

    }
    public function edit($id)
    {
        echo $id;
        $categorie=new Categories();
        $data=$categorie->where('id',$id)
            ->get()->toArray();
        return view('editcategories',compact("data"));

    }
    public function editstore(Request $request)
    {
        $request->toArray();

    }
}

