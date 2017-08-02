<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\deal;
use Illuminate\Support\Facades\DB;

class WebServicesController extends Controller
{

    public function categories()
    {
        //        echo "cate";
        $data=Categories::all()->toArray();

        $i=0;
        foreach ($data as $v)
        {
            $data[$i]['news_image']= asset('storage/'.$v['categories_image']);
            $i++;
        }
        echo json_encode($data);
    }

    public function subcategories(Request $request)
    {
        // echo "subcat";
       $data= SubCategories::where('cat_id',$request->cat_id )->get();
        $data=$data->toArray();
        echo json_encode($data);

    }

    public function news(Request $request)
    {
       //dd($request->toArray());


         $query = deal::select();

         if($request->categories)
         {
             if($request->language!=null) {



                 $query->whereIn('cat_id', $request->categories)->Where('language', '=', $request->language);

             }
             else{

                 $query->whereIn('cat_id', $request->categories);

             }


         }
         else
         {
             if($request->language!=null) {



                 $query->Where('language', '=', $request->language);

             }

         }




        $data = $query->get();

        //dd($data->toArray());
        $i=0;
        foreach ($data as $v)
        {
            $data[$i]['news_image']= asset('storage/'.$v['news_image']);
            $i++;
        }

      //  $data= deal::where('cat_id',$request->cat_id )->get();
       // $data=$data->toArray();
        echo json_encode($data);
    }
}