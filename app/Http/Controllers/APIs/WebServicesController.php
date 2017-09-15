<?php

namespace App\Http\Controllers\APIs;

use App\Models\AppUser;
use App\Models\Category;
use App\Models\DeviceInfo;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\deal;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use Illuminate\Support\Facades\Mail;
use Response;
use App\Mail\ForgotPassword;


class WebServicesController extends Controller
{

    /**
     *
     */
    public function categories()
    {
        //        echo "cate";
        $data = Categories::all()->toArray();

        $i = 0;
        foreach ($data as $v) {
            $data[$i]['news_image'] = asset('storage/' . $v['categories_image']);
            $i++;
        }
        echo json_encode($data);
    }

    /**
     * @param Request $request
     */
    public function subcategories(Request $request)
    {
        // echo "subcat";
        $data = SubCategories::where('cat_id', $request->cat_id)->get();
        $data = $data->toArray();
        echo json_encode($data);

    }

    /**
     * @return mixed
     */
    public function allLanguages(Request $request)
    {
        $device_array = [
            'device_id' => $request->device_id,
            'device_token' => $request->device_token,
            'device_type' => $request->device_type,
        ];
            $check = DeviceInfo::where('device_id',$request->device_id)->first();
             if($check == null){
                 $device_array['created_at'] = Carbon::now();
                DeviceInfo::insert($device_array);
            }
            else{
                $device_array['updated_at'] = Carbon::now();
                DeviceInfo::where('device_id',$request->device_id)->update($device_array);
            }
        $laguages = Language::all()->toArray();
        if (count($laguages) > 0)
            return Response::json(['code' => 200, 'status' => true, 'message' => 'Data Found', 'data' => $laguages]);
        else
            return Response::json(['code' => 500, 'status' => true, 'message' => 'Data not Found', 'data' => array()]);

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function categoryByLanguage(Request $request)
    {

        $temp_categories = Category::GetCategoryByLang($request->language_id)->get();
        if ($temp_categories->count() > 0) {
            $categories = $temp_categories->toArray();
            $categoriesArray = [];
            foreach ($categories as $key_cate => $value_cate) {
                $value_cate['category_icon'] = asset('storage/' . $value_cate['category_icon']);
                array_push($categoriesArray, $value_cate);
            }
            return Response::json(['code' => 200, 'status' => true, 'message' => 'Data Found.', 'data' => $categoriesArray]);
        } else {
            return Response::json(['code' => 500, 'status' => false, 'message' => 'No category found in this language.', 'data' => array()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getNews(Request $request)
    {
//        dd($request->all());
        if ($request->top_news == 0 && $request->recommended_news == 0 && $request->cat_id != '') {
            $temp_news = News::GetNewsByCat($request->cat_id)->get();

        }
        if ($request->top_news != 0 && $request->recommended_news == 0 && $request->cat_id == '') {
            $temp_news = News::GetNewsByCreatedAt($request->language)->orderBy('created_at', 'desc')->take(10)->get();
        }
        if ($request->top_news == 0 && $request->recommended_news != 0 && $request->cat_id == '') {
            $temp_news = News::GetNewsByLike($request->language)->orderBy('like', 'desc')->take(10)->get();
        }
        $fav_array = [];
        if ($temp_news->count() > 0) {
            if($request->user_id != 0){
                $user = AppUser::find($request->user_id);
                $user_favourite = $user->userFavourite()->get();
                if($user_favourite->count() > 0){
                    $fav = true;
                     foreach ($user_favourite as $key_fav => $value_fav){
                        array_push($fav_array ,$value_fav->news_id);
                    }
                }
                else{
                    $fav = false;
                }
            }
            else{
                $fav = false;
            }
            $news = [];

            foreach ($temp_news as $key_news => $value_news) {
                $x = $value_news->toArray();


                $created = new \Carbon\Carbon($value_news->created_at);
                $x['created'] = $created->diffForHumans();


                $newsimages = $value_news->newsImage()->get()->toArray();
//                        dd($newsimages);
                if (count($newsimages) > 0) {
                    $x['image'] = asset('storage/' . $newsimages[0]['news_image']);
                } else {
                    $x['image'] = '';


                }

                $x['newsImage'] = [];
                foreach ($newsimages as $key_img => $value_img) {
                    array_push($x['newsImage'], asset('storage/' . $value_img['news_image']));
                }
                if($fav){
                    if(in_array($value_news->id,$fav_array)){
                        $x['favourite'] = true;
                    }
                    else{
                        $x['favourite'] = false;
                    }
                }
                else{
                    $x['favourite'] = false;
                }


                array_push($news, $x);

            }
            return Response::json(['code' => 200, 'status' => true, 'message' => 'Data Found.', 'data' => $news]);
        } else {
            return Response::json(['code' => 500, 'status' => false, 'message' => 'No News is found write now.', 'data' => array()]);
        }

    }

    public function searchNews(Request $request){
        $temp_news = News::GetSearchedNews($request->value)->orderBy('created_at', 'desc')->take(10)->get();
        if ($temp_news->count() > 0) {
            $news = [];
            foreach ($temp_news as $key_news => $value_news) {
                $x = $value_news->toArray();
                $created = new \Carbon\Carbon($value_news->created_at);
                $x['created'] = $created->diffForHumans();


                $newsimages = $value_news->newsImage()->get()->toArray();
//                        dd($newsimages);
                if (count($newsimages) > 0) {
                    $x['image'] = asset('storage/' . $newsimages[0]['news_image']);
                } else {
                    $x['image'] = '';


                }

                $x['newsImage'] = [];
                foreach ($newsimages as $key_img => $value_img) {
                    array_push($x['newsImage'], asset('storage/' . $value_img['news_image']));
                }

                array_push($news, $x);

            }
            return Response::json(['code' => 200, 'status' => true, 'message' => 'Data Found.', 'data' => $news]);
        } else {
            return Response::json(['code' => 500, 'status' => false, 'message' => 'No News is found write now.', 'data' => array()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function relatedNews(Request $request)
    {

        $temp_news = News::GetNewsByCreatedAt($request->language_id)->GetNewsByCat($request->cat_id)->orderBy('created_at', 'desc')->take(3)->get();

        if ($temp_news->count() > 0) {
            $news = [];
            foreach ($temp_news as $key_news => $value_news) {
                $x = $value_news->toArray();
                $created = new \Carbon\Carbon($value_news->created_at);
                $x['created'] = $created->diffForHumans();
                $newsimages = $value_news->newsImage()->get()->toArray();
                if (count($newsimages) > 0)
                    $x['image'] = asset('storage/' . $newsimages[0]['news_image']);
                else
                    $x['image'] = '';

                $x['newsImage'] = [];
                foreach ($newsimages as $key_img => $value_img) {
                    array_push($x['newsImage'], asset('storage/' . $value_img['news_image']));
                }

                array_push($news, $x);

            }
            return Response::json(['code' => 200, 'status' => true, 'message' => 'Data Found.', 'data' => $news]);
        } else {
            return Response::json(['code' => 500, 'status' => false, 'message' => 'No News is found write now.', 'data' => array()]);
        }

    }

    public function forgotPassword(Request $request)
    {
        if (is_numeric($request->value)) {
            $app_user = AppUser::where('mobile_no',$request->value)->first();

        } else {
            $app_user = AppUser::whereEmail($request->value)->first();
        }

        if($app_user == null){
            return Response::json(['code' => 500, 'status' => false, 'message' => 'User is not registered with us.', 'data' => array()]);
        }
        else{
            $password = str_random(8);
            $app_user->password = bcrypt($password);
            $app_user->save();
            if($app_user->mobile_no != null){
                $this->send_opt_mobile($app_user->mobile_no,$password);
            }
            Mail::to($app_user->email)->send(new ForgotPassword($app_user,$password));
            if (count(Mail::failures()) == 0) {
                return Response::json(['code' => 200, 'status' => true, 'message' => 'New Password has been send to register email and mobile no. address.','data' => array()]);
            }
        }
    }


    function send_opt_mobile($mobile, $password)
    {
        $authKey = "84215Aeu0Yhfnyc55470221";

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $mobile;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "NEWPRT";

        //Your message to send, Add URL encoding here.
        $message = urlencode("News Portal your new password is $password");

        //Define route
        $route = "4";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        //API URL
        $url="https://api.msg91.com/api/sendhttp.php?authkey='$authKey'&mobiles='$mobileNumber'&message='$message'&sender='$senderId'&route=4&country=91";


        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);
    }

}