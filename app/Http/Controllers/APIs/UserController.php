<?php

namespace App\Http\Controllers\APIs;

use App\Models\AppUser;
use App\Models\Favourite;
use App\Models\Like;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use JWTAuthException;


class UserController extends Controller
{
    /**
     * @param array $data
     * @return int
     */
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


    /**
     * @param array $data
     * @return int
     */
    protected function createAppUserWithoutPass(array $data)
    {
        return AppUser::insertGetId([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'created_at' => Carbon::now()
        ]);
    }


    /**
     * @param $token
     * @return mixed
     */
    protected function getAuthUserByToken($token){
        return JWTAuth::toUser($token);
    }

    /**
     * @param Request $request
     * @return mixed
     */
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

            $app_user = AppUser::find($usertemp);
            $user = $app_user->toArray();

             $token = JWTAuth::fromUser($app_user);
                $user['token'] = $token;
                return Response::json(['code' => 200,'status' => true, 'message' => 'User Register Successfully','data' => $user]);
         }

        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage(),'data' => array()]);
        }


    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function loginAppUser(Request $request)
    {
        try {
            $app_user = AppUser::GetAppUserByMobOrEmail($request->value)->first();

            if ($app_user== null) {
                return Response::json(['code' => 200, 'status' => false, 'message' => 'User is not register with us']);
            }
            if (Hash::check($request->password, $app_user->password)) {
                $token = JWTAuth::fromUser($app_user);
                $user = $app_user->toArray();
                $user['token'] = $token;
                return Response::json(['code' => 200, 'status' => true, 'data' => $user]);
            } else {
                return Response::json(['code' => 200, 'status' => false, 'message' => 'User Password is not match with email address']);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function likeNews(Request $request){
        $user = $this->getAuthUserByToken($request->token);
     if($user->count() > 0){
           $check = Like::UserLike($user->id)->NewsLike($request->news_id)->get();
           if($check->count() > 0){
               return Response::json(['code' => 500, 'status' => true,'message' => 'User alerdy like these news','data' =>array()]);
           }
           else{
                $data = [
                    'news_id' => $request->news_id,
                    'user_id' => $user->id,
                    'created_at' => Carbon::now()
                ];

                Like::insert($data);
                $news = News::find($request->news_id);
                $news->like = ++$news->like;
                $news->save();

               return Response::json(['code' => 200, 'status' => true,'message' => 'News like successfully','data' =>array()]);
           }
     }

    }


    public function addToFavouriteNews(Request $request){
        $user = $this->getAuthUserByToken($request->token);
        if($user->count() > 0){
            $check = Favourite::UserFavourite($user->id)->NewsFavourite($request->news_id)->get();
            if($check->count() > 0){
                $delete= Favourite::UserFavourite($user->id)->NewsFavourite($request->news_id)->delete();
                return Response::json(['code' => 200, 'status' => true,'message' => 'News remove from favourite successfully','data' =>array()]);
            }
            else{
                $data = [
                    'news_id' => $request->news_id,
                    'user_id' => $user->id,
                    'created_at' => Carbon::now()
                ];

                Favourite::insert($data);
                return Response::json(['code' => 200, 'status' => true,'message' => 'News added to favourite successfully','data' =>array()]);
            }
        }
    }




}
