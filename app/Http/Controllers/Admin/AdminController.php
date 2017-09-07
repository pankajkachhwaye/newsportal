<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\AppUser;
use App\Models\DeviceInfo;
use App\Models\Language;
use App\Models\News;
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

    public function showNews(){
        $page = 'news';
        $sub_page = 'news-show';
        $temp_news = News::all();
        $news = [];
        foreach ($temp_news as $key_news => $value_news){
            $category = $value_news->category->first(['category_name']);
            $x =$value_news->toArray();
            $x['category_name'] = $category->category_name;
            unset($x['category']);
            array_push($news,$x);
        }
//        dd($news);
        return view('shownews',compact('news','page','sub_page'));

    }

    public function deleteNews($id){
        $news = News::find($id);
        $news->delete();
        return back()->with('returnStatus', true)->with('status', 101)->with('message','News deleted successfully');
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
        }

        return back()->with('returnStatus', true)->with('status', 101)->with('message','notification send successfully');

    }

    public function notifySelectedUsers(Request $request){
        foreach ($request->users as $key_user => $value_user){
            $temp_user = AppUser::find($value_user);
            $user_device = $temp_user->deviceInfo;
            if($user_device != null){
                $user_device->notify(new GenralNotification($request->notification_title, $request->notification_body));
            }
        }
        return Response::json(['code' => 200, 'status' => true, 'message' => 'notification send successfully to selected users']);

    }

    public function sendNotificationRegisteredUser(){
        $page = 'notification';
        $sub_page = 'notify-registerd-users';
        $app_users = AppUser::all();
//        dd($app_users);
        return view('admin.notifyregisterd',compact('page','sub_page','app_users'));
    }


    public function firebase_notification($device_type,$device_token,$title,$body){

        define("TAG", "0");
        $date = date('Y-m-d');
        $current_date= strtotime($date);
        $server_key = 	'AAAAN1pXap0:APA91bGolaXhXdz-gH74YVIGtM5lryB67HxZpKtayOmfD7JFSv2dnaGjLdJJJ2ezzeLBN1hWCww23dQIxlsPT-YX9fytENzNrLBLUip4hNgrPMYcxwGK5quYL2TDggzv_FvoUPAiA2gU';
        $url = 'https://fcm.googleapis.com/fcm/send';
        if($device_type=='android')
        {

            /*$id1='deeSDmxSi50:APA91bHNawMFOeafW6TDD3xKfgnEP0rKZpLOJjYIiVdE5zMxK2seKoc8rPnqzcbuc25ASKNTUm73kvUUbD_ElB07Z_VDUhv3a7Cr-8390Q8AAhErXJKIc8qxeBulv3vx7bdXldh0Dj85';*/
            $fields = array (
                'registration_ids' => array($device_token),
                'data' => array( "title" =>  $title,
                    "body" =>  $body,
                    "type"=>TAG
                ),

                'notification' => array( "body" =>  $body,
                    "title" => $title,
                    "icon"=>"icon",
                    "tag"=>TAG
                )
            );
            //header with content_type api key
            $headers = array('Content-Type:application/json',
                'Authorization:key='.$server_key);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            // print_r($result);
            if ($result == FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            print_r($result);
        }


        else if($device_type=='ios'){


            $tokens = array($device_token);

            //Title of the Notification.
            $title = $title;

            //Body of the Notification.
            $body = "this is behindbars app";

            //Creating the notification array.
            $notification = array('title' =>$title , 'text' => $body);

            //This array contains, the token and the notification. The 'to' attribute stores the token.
            $arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification,'priority'=>'high');

            //Generating JSON encoded string form the above array.
            $json = json_encode($arrayToSend);
            //Setup headers:
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $server_key; // key here

            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

            //Send the request
            $response = curl_exec($ch);
            //print_r($arrayToSend);
            //Close request
            curl_close($ch);


            echo "pre";
            print_r($response);
        }

    }
}
