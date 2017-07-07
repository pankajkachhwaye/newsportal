<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Categories;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


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

//           dd($request);

        $categorie->categories_name= $request->categories_name;
        $categories_image= $request->categories_image;
        $ext = $categories_image->getClientOriginalExtension();
        $path= Storage::putFileAs('categories', $categories_image, time().$categorie->categories_name.".".$ext);('');
        $categorie->categories_image=$path;
        $categorie->save();

        return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Category Added successfully');
      //  return redirect('/Categories/show');



    }
    public function show()
    {
        $categorie=new Categories();
        $data=$categorie->get()->toArray();
        return view('showcategories',compact("data"));
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
