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

        $insert = News::insertGetId($insertArray);
        foreach ($data as $key_img =>$value_img){
            $random = str_random(5);
            $ext = $value_img->getClientOriginalExtension();
            $path= Storage::putFileAs('news_Image', $value_img, time().$cat_id.$random.".".$ext);
            $temp_data = [
                'news_id' =>$insert,
                'news_image' =>$path,
                'created_at'=>Carbon::now()
            ];

            $insert_img = NewsImage::insert($temp_data);
        }
        return ['code' => 101, 'message' => 'News Added Successfully'];

    }
}