<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoriesController extends Controller
{
    public function __construct()
    {

    }


    public function index()
    {
        $subcategorie = new SubCategories();
        $data= $subcategorie->get()->toArray();
       // dd($data);
        return view('showsubcategorie',compact('data'));

    }

    public function add()
    {
        $data =Categories::GetCategoriesName()->get()->toArray();
        return view('subcategorie',compact('data'));
    }
    public function store(Request $request)
    {
        $subcategorie = new SubCategories();

        $subcategorie ->cat_id= $request->cat_id;
        $subcategorie ->subcategories_name= $request->subcategories_name;
        $subcategorie_img= $request->subcategories_image;
        $ext = $subcategorie_img->getClientOriginalExtension();
        $path= Storage::putFileAs('subcategories', $subcategorie_img, time().$subcategorie ->subcategories_name.".".$ext);
        $subcategorie->subcategories_image=$path;
        $subcategorie->save();

        return back()->with('returnStatus', true)->with('status', 101)->with('message', 'SubCategory Added successfully');
        //  return redirect('/Categories/show');



    }
    public function show()
    {

    }
    public function edit($id)
    {
        //echo $id;
        $categorie=new SubCategories();
        $data=$categorie->where('id',$id)
            ->get()->toArray();
        //dd($data);
        return view('editsubcategories',compact("data"));
    }

    public function update(Request $request)
    {

    }
    public function delete($id)
    {
        echo "in delete with id :".$id;

    }
}
