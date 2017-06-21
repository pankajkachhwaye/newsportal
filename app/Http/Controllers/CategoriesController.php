<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Controller
{
    //
    public function add()
    {
        echo "Categories";
        return view('categories');
    }
    public function store(Request $request)
    {
        $categorie=new Categories();
        $categorie->categories_name= $request->categories_name;
        $categories_image= $request->categories_image;
        $ext = $categories_image->getClientOriginalExtension();
       $path= Storage::putFileAs('categories', $categories_image, time().$categorie->categories_name.".".$ext);('');
        echo $path;
        $categorie->categories_image=$path;
        $categorie->save();

        echo Storage::url("file.jpg");
        echo"<br>";
      echo  Storage::url($path);


    }
    public function show()
    {

    }
    public function delete()
    {

    }
}
