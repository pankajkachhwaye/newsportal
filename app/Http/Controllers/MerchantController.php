<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
class MerchantController extends Controller
{
    //

    public function store(Request $request)
    {
        //$mercheant =Merchent::all();
       // dd($request->all());
        $merchant= new Merchent();

        $merchant->companyName=$request->companyName;
        $merchant->location=$request->location;
        $merchant->title= $request->title;
        $merchant->firstName=$request->firstName;
        $merchant->lastName=$request->lastName;
        $merchant->category=$request->category;

        $merchant->mobileNo=$request->mobileNo;
        $merchant->landlineNo=$request->landlineNo;
        $merchant->webAddress=$request->webAddress;
        $merchant->profilePic="htt//:localhost/a.jpg";

            $merchant->save();
            //dd($merchant);

    }

    public function registrction()
    {
        return view('merchant_reg');
    }

    public function fileupload()
    {
        return view('fileupload');


    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function fileupload_store(Request $request)
    {


//        echo asset('storage/file.txt');
//        dd("aa");
        $image = $request->profilePic;

//      Storage::disk('local')->put('f.jpg', $image);
        Storage::disk('local')->put('file.txt', 'contents is written inside file.txt');

      // $path= Storage::putFile($image, new File('/admin'));
       // print_r($req->profilePic);
        //$path = $req->file('profilePic')->store('storage');

//        $ext = $image->getClientOriginalExtension();
//        $path = Storage::putFileAs(
//            $request->user()->name, $image, $request->user()->id .date('Y_m_d H_i_s'). ("." . $ext)
//        );
       // $path = Storage::putFile('avatars', $req->file('profilePic'));

       // return $path;


    }
}
