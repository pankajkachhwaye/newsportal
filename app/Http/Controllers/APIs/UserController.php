<?php

namespace App\Http\Controllers\APIs;

use App\Models\AppUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function createAppUserWithPass(array $data)
    {
        return AppUser::insertGetId([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'password' => bcrypt($data['password']),
            'created_at' => Carbon::now()
        ]);
    }


    protected function createAppUserWithoutPass(array $data)
    {
        return AppUser::insertGetId([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'created_at' => Carbon::now()
        ]);
    }


    public function registerAppUser(Request $request)
    {
     try {

        if($request->mobile_no != ''){
            $tempuser = AppUser::CheckUser($request->email,$request->mobile_no)->first();
        }
        else{
            $tempuser = AppUser::whereEmail($request->email)->first();
        }

        if($tempuser != null){
            return Response::json(['code' => 400, 'status' => false,'message' => 'User already Register with this email address','data' => array()]);
        }
        else{
            if($request->full_name != '')
                $request->full_name= $request->full_name;
            else
                return Response::json(['code' => 400, 'status' => false,'message' => 'Please provide full name','data' => array()]);

            if($request->email != '')
                $request->email = $request->email;
            else
                return Response::json(['code' => 400,'status' => false, 'message' => 'Please provide email address','data' => array()]);

            if($request->password == null){
                $usertemp = $this->createAppUserWithoutPass($request->all());
            }
            else{
                $usertemp = $this->createAppUserWithPass($request->all());
            }

                $user = AppUser::find($usertemp);


                return Response::json(['code' => 200,'status' => true, 'message' => 'User Register Successfully','data' => $user]);



        }

        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage(),'data' => array()]);
        }


    }



    public function loginAppUser(Request $request)
    {
        try {
            $app_user = AppUser::GetAppUserByMobOrEmail($request->value)->first();

            if ($app_user== null) {
                return Response::json(['code' => 200, 'status' => false, 'message' => 'User is not register with us']);
            }
            if (Hash::check($request->password, $app_user->password)) {
                return Response::json(['code' => 200, 'status' => true, 'data' => $app_user]);
            } else {
                return Response::json(['code' => 200, 'status' => false, 'message' => 'User Password is not match with email address']);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }



}
