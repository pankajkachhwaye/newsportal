<?php

namespace App\Http\Controllers;
use App\Form;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    //
    public function form_data()
    {
        $data=Form::all();
        return Response::json($data);
        //echo
    }

    public function insert(Request $request)
    {
        $form= new Form;
        $form->name=$request->email;
        $form->password=$request->password;

        if($form->save()) {

            return Response::json(["status"=> "true", "message"=>"data inserted"]);
        }
        else
        {
            return Response::json(["status" =>"false", "message"=>"data inserted"]);

        }


    }


}
