<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\AppUser;
use App\Models\DeviceInfo;
use App\Models\Language;
use App\Models\News;
use App\Models\NewsImage;
use App\Notifications\GenralNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Response;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLanguageForm(){
        $page = 'language';
        $laguages = Language::all()->toArray();
        return view('admin.languageform',compact('laguages','page'));
    }

    public function postLanguage(Request $request,CrudRepository $repo){
        $save =$repo->createNew($request->all(), new Language());
        if($save['code'] == 101){
            $locations = Language::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Language Added Successfully')->with($locations);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }

    public function editLanguageForm($lang_id){
        $page = 'language';
        $laguage = Language::find($lang_id);
        return view('admin.editlanguage',compact('laguage','page'));
    }

    public function deleteLanguage($lang_id){
        $lang = Language::find($lang_id);
        $lang->delete();
        return back()->with('returnStatus', true)->with('status', 101)->with('message','Language deleted successfully');
    }

    public function updateLanguage(Request $request,CrudRepository $repo){
        $update = $repo->updateModelById($request->all(),new Language());
        if($update['code'] == 101){
            $locations = Language::all()->toArray();

            return redirect('/add-language')->with('returnStatus', true)->with('status', 101)->with('message', 'Language update successfully')->with($locations);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }

    }

    public function addNewsForm(){
        $page = 'news';
        $sub_page = 'news-add';
        $laguages = Language::all()->toArray();
        return view('admin.newsadd',compact('laguages','page','sub_page'));
    }

    public function categoryByLang($id){
        $temp_categories = Category::GetCategoryByLang($id)->get();
        if($temp_categories->count() > 0){
            $categories =   $temp_categories->toArray();
            $categoriesArray = [];
            foreach ($categories as $key_cate => $value_cate){
                $value_cate['category_icon'] =   asset('storage/'.$value_cate['category_icon']);
                array_push($categoriesArray,$value_cate);
            }
            return Response::json(['code' => 200, 'status' => true,'message' => 'Data Found.','data' =>$categoriesArray]);
        }
        else{
            return Response::json(['code' => 500, 'status' => true,'message' => 'No category found in this language.','data' =>array()]);
        }
    }

    public function postNews(Request $request, CrudRepository $repo){
        $save =$repo->addNews($request->all());
        if($save['code'] == 101){
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }

    public function updateNews(Request $request, CrudRepository $repo){
        $save =$repo->updateNews($request->all());
        if($save['code'] == 101){
            return redirect('show-news')->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }

    }

    public function showNews(){
        $page = 'news';
        $sub_page = 'news-show';
        $temp_news = News::all();
        $news = [];
        foreach ($temp_news as $key_news => $value_news){
            $category = $value_news->category;
            $x =$value_news->toArray();
            $x['category_name'] = $category->category_name;
            unset($x['category']);
            array_push($news,$x);
        }
//        dd($news);
        return view('shownews',compact('news','page','sub_page'));

    }

    public function editNews($news_id){
        $page = 'news';
        $sub_page = 'news-show';

        $news = News::find($news_id);
        $category = $news->category;
        $news->category_name = $category->category_name;
        $newsImage = $news->newsImage;

        return view('admin.editnews',compact('newsImage','news','page','sub_page'));

    }

    public function deleteNews($id){
        $news = News::find($id);
        $news->delete();
        return back()->with('returnStatus', true)->with('status', 101)->with('message','News deleted successfully');
    }

    public function deleteNewsImage($id){
        $newsImg = NewsImage::find($id);
        $newsImg->delete();
        return Response::json(['code' => 200, 'status' => true, 'message' => 'Image deleted successfully']);
    }



    public function sendNotificationAllUser(){
        $page = 'notification';
        $sub_page = 'notify-all-users';
        return view('admin.notifyall',compact('page','sub_page'));
    }

    public function notifAllUsers(Request $request){

        $devices = DeviceInfo::all();

        foreach ($devices as $key_device => $value_device){

            $value_device->notify(new GenralNotification($request->notification_title, $request->notification_body));
            $notify =  $this->firebase_notification($value_device->device_token,$request->notification_title, $request->notification_body);
        }

        return back()->with('returnStatus', true)->with('status', 101)->with('message','notification send successfully');

    }

    public function notifySelectedUsers(Request $request){
        foreach ($request->users as $key_user => $value_user){
            $temp_user = AppUser::find($value_user);
            $user_device = $temp_user->deviceInfo;
            if($user_device != null){
                $user_device->notify(new GenralNotification($request->notification_title, $request->notification_body));
               $notify =  $this->firebase_notification($user_device->device_token,$request->notification_title, $request->notification_body);

            }
        }
        return Response::json(['code' => 200, 'status' => true, 'message' => 'notification send successfully to selected users']);

    }

    public function sendNotificationRegisteredUser(){

        $page = 'notification';
        $sub_page = 'notify-registered-users';
        $app_users = AppUser::all();
//        dd($app_users);
        return view('admin.notifyregisterd',compact('page','sub_page','app_users'));
    }


    public function firebase_notification($device_token,$title,$body){
        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        //The device token.
        /*$token = "eA-RyGHUo38:APA91bE_Giwf5lGGH87syUFLy__NS8g_YYR8W2LWp9hvss_gnTlDCkrHZekz44pI_6LZU0G1dJ4JUO5bDm6J_U6TsOgQqd4MzsUN37EP-JKA2NdonXIvjCrAPNz3Ui6xwPPbt608jltI";*/
        $token = $device_token;

        //Title of the Notification.
        $title = $title;

        //Body of the Notification.
        $body = $body;

        //Creating the notification array.
        $notification = array('title' =>$title , 'text' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' => $token, 'notification' => $notification);
        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);

        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        //behindbar
        //$headers[] = 'Authorization: key= AAAANYa3Tpo:APA91bFFgq6p2EqPi2OPhNFYdHChomOILYJr4mqbPGQANq5w6axeEZwojxfkL0Iyknsvte825OgjfhyJ7dnIMVOzS7uRMqE502y0amwipgpw6GM5yeQAilUUgiCASrvkYpc8vwNj9EQk'; //server key here


        //poochplay
        $headers[] = 'Authorization: key= AAAA1IfBAQ0:APA91bFIw8AKJ7yyuzWYZ-IG6nFGCKJ9EeTcsoinhizMWOOV_Aoh8MASAk2TZDMVUxMIrwq0ZP8AgAVf4mV8DubZsh8piKTuhq9UqMBDMxLW_K-uq2m18sFzIQCLiAStZnl7mYv8Dnqs'; //server key here

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        return $response;

    }
}
