<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class FormController extends Controller
{
    //
    public function index()
    {
        return view('form');
    }

    /**
     * @param Request $request
     * @internal param $Request $
     */
    public function get_data(Request $request)
    {
////        dd($request->email);
//
//
//        $form= new Form;
//        $form->name=$request->email;
//        $form->password=Hash::make($request->password);
//
//        $form->save();

      //  dd("hello");
       $data=Form::all();
//       dd($data);
       foreach ($data as $value)
       {
           echo $value->password."<br>";

       }


    }
}
