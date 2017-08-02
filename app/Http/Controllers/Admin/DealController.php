<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\deal;
use Response;
use Illuminate\Support\Facades\Storage;


class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $news=new deal();
        $data=$news->get()->toArray();

//        dd(asset('storage/'.$data[0]['news_image']) );
        return view('showdeal',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =Categories::GetCategoriesName()->get()->toArray();
        return view('deal',compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          //  dd($request->toArray());

            $news=new deal();
            $news->cat_id=$request->cat_id;
            $news->news_title=$request->news_title;
            $news->language=$request->language;
            $news->news_description=$request->news_description;
            $news->city=$request->city;
            $news->news_title=$request->news_title;
            $news->ref_url=$request->ref_url;
            $news->country=$request->country;
            $news->news_video_url=$request->news_video_url;


        $news_image=$request->news_image;
        $ext = $news_image->getClientOriginalExtension();
        $path= Storage::putFileAs('news', $news_image, time().$news->cat_id.".".$ext);
        $news->news_image=$path;
        $news->save();

        return redirect('Deals')->with('returnStatus', true)->with('status', 101)->with('message', 'News added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        //return view('showcategories',compact("data"));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        echo $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


    }
    public function getSubcatData($id)
    {
        $data=SubCategories::GetSubCatByCatId($id)->get()->toArray();
        return Response::json($data);
        

    }
}
