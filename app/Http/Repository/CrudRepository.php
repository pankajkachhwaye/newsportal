<?php

namespace App\Http\Repository;


use App\Models\AddressModel;
use App\Models\CouponModel;
use App\Models\DeliveryInformationModel;
use App\Models\DiscountModel;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\TimingModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\DeviceInfo;
class CrudRepository
{

    public function createNew($data = [], $modal)
    {
        try {

            $data['created_at'] = Carbon::now();
            $modal->create($data);
            return ['code' => 101, 'message' => 'success'];
        } catch (\Exception $exception) {
            return ['code' => 503, 'message' => $exception->getMessage()];
        }

    }


    public function updateModelById($data = [], $modal){
        try {
            $id = $data['id'];
            unset($data['_token']);
            unset($data['id']);
            $data['updated_at'] = Carbon::now();
            $modal->where('id',$id)->update($data);
            return ['code' => 101, 'message' => 'success'];
        } catch (\Exception $exception) {
            return ['code' => 503, 'message' => $exception->getMessage()];
        }
    }

    public function addNews($data){

        unset($data['_token']);
        $language = $data['language'];
        unset($data['language']);
        $lang_id = $data['lang_id'];
        unset($data['lang_id']);
        $cat_id = $data['cat_id'];
        unset($data['cat_id']);
        $news_title = $data['news_title'];
        unset($data['news_title']);
        $news_description = $data['news_description'];
        unset($data['news_description']);
        $city = $data['city'];
        unset($data['city']);
        $ref_url = $data['ref_url'];
        unset($data['ref_url']);
        $country = $data['country'];
        unset($data['country']);
        $news_video_url = $data['news_video_url'];
        unset($data['news_video_url']);
        unset($data['counter']);
        $insertArray = [
            'cat_id'=>$cat_id,
            'lang_id'=>$lang_id,
            'news_title'=>$news_title,
            'language'=>$language,
            'news_description'=>$news_description,
            'city'=>$city,
            'ref_url'=>$ref_url,
            'country'=>$country,
            'news_video_url'=>$news_video_url,
            'created_at'=>Carbon::now()

        ];
        foreach ($data as $key_img =>$value_img){
            $ext = $value_img->getClientOriginalExtension();
//            dd($ext);
            $ext_array = ['jpg','png','jpeg','gif'];
            if(!in_array($ext, $ext_array)){
                return ['code' => 101, 'message' => 'wrong file format please select correct file format.'];
            }
        }
        $insert = News::insertGetId($insertArray);
        foreach ($data as $key_img =>$value_img){
            $random = str_random(5);
            $ext = $value_img->getClientOriginalExtension();
            $ext_array = ['jpg','png','jpeg','gif'];
            if(!in_array($ext, $ext_array)){
                return ['code' => 101, 'message' => 'wrong file format please select correct file format.'];
            }
            $path= Storage::putFileAs('news_Image', $value_img, time().$cat_id.$random.".".$ext);
            $temp_data = [
                'news_id' =>$insert,
                'news_image' =>$path,
                'created_at'=>Carbon::now()
            ];

            $insert_img = NewsImage::insert($temp_data);
        }

        $devices = DeviceInfo::all();
        $title = 'NewsPortal';

        foreach ($devices as $key_device => $value_device){
            $notify =  $this->firebase_notification($value_device->device_token,$title, $news_title);
        }
        return ['code' => 101, 'message' => 'News Added Successfully'];

    }

    public function updateNews($data){
        unset($data['_token']);
        $news_id = $data['news_id'];
        unset($data['news_id']);
        $language = $data['language'];
        unset($data['language']);
        $lang_id = $data['lang_id'];
        unset($data['lang_id']);
        $cat_id = $data['cat_id'];
        unset($data['cat_id']);
        $news_title = $data['news_title'];
        unset($data['news_title']);
        $news_description = $data['news_description'];
        unset($data['news_description']);
        $city = $data['city'];
        unset($data['city']);
        $ref_url = $data['ref_url'];
        unset($data['ref_url']);
        $country = $data['country'];
        unset($data['country']);
        $news_video_url = $data['news_video_url'];
        unset($data['news_video_url']);
        unset($data['counter']);
        $category_name = $data['category_name'];
        unset($data['category_name']);
//        dd($data);

        $insertArray = [
            'cat_id'=>$cat_id,
            'lang_id'=>$lang_id,
            'news_title'=>$news_title,
            'language'=>$language,
            'news_description'=>$news_description,
            'city'=>$city,
            'ref_url'=>$ref_url,
            'country'=>$country,
            'news_video_url'=>$news_video_url,
            'created_at'=>Carbon::now()

        ];
        foreach ($data as $key_img =>$value_img){
            $ext = $value_img->getClientOriginalExtension();
//            dd($ext);
            $ext_array = ['jpg','png','jpeg','gif'];
            if(!in_array($ext, $ext_array)){
                return ['code' => 101, 'message' => 'wrong file format please select correct file format.'];
            }
        }

        $insert = News::where('id',$news_id)->update($insertArray);
        foreach ($data as $key_img =>$value_img){
            $random = str_random(5);
            $ext = $value_img->getClientOriginalExtension();
            $ext_array = ['jpg','png','jpeg','gif'];
            if(!in_array($ext, $ext_array)){
                return ['code' => 101, 'message' => 'wrong file format please select correct file format.'];
            }
            $path= Storage::putFileAs('news_Image', $value_img, time().$cat_id.$random.".".$ext);
            $temp_data = [
                'news_id' =>$news_id,
                'news_image' =>$path,
                'created_at'=>Carbon::now()
            ];

            $insert_img = NewsImage::insert($temp_data);
        }
        return ['code' => 101, 'message' => 'News update Successfully'];

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
