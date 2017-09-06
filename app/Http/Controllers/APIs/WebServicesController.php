<?php

namespace App\Http\Controllers\APIs;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\SubCategories;
use App\deal;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use Response;

class WebServicesController extends Controller
{

    /**
     *
     */
    public function categories()
    {
        //        echo "cate";
        $data=Categories::all()->toArray();

        $i=0;
        foreach ($data as $v)
        {
            $data[$i]['news_image']= asset('storage/'.$v['categories_image']);
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
       $data= SubCategories::where('cat_id',$request->cat_id )->get();
        $data=$data->toArray();
        echo json_encode($data);

    }

    /**
     * @return mixed
     */
    public function allLanguages(){
        $laguages = Language::all()->toArray();
        if(count($laguages) > 0)
            return Response::json(['code' => 200, 'status' => true,'message' => 'Data Found','data' =>$laguages]);
        else
            return Response::json(['code' => 500, 'status' => true,'message' => 'Data not Found','data' =>array()]);

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function categoryByLanguage(Request $request){

        $temp_categories = Category::GetCategoryByLang($request->language_id)->get();
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
            return Response::json(['code' => 500, 'status' => false,'message' => 'No category found in this language.','data' =>array()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getNews(Request $request){
//        dd($request->all());
        if($request->top_news == 0 && $request->recommended_news == 0 && $request->cat_id != ''){
            $temp_news = News::GetNewsByCat($request->cat_id)->get();

        }
        if($request->top_news != 0 && $request->recommended_news == 0 && $request->cat_id == ''){
            $temp_news = News::GetNewsByCreatedAt($request->language)->orderBy('created_at' ,'desc')->take(3)->get();
        }
        if($request->top_news == 0 && $request->recommended_news != 0 && $request->cat_id == ''){
            $temp_news = News::GetNewsByLike($request->language)->orderBy('like' ,'desc')->take(2)->get();
        }

        if($temp_news->count() > 0){
                $news = [];
            foreach ($temp_news as $key_news => $value_news){
                    $x = $value_news->toArray();
                $created = new \Carbon\Carbon($value_news->created_at);
                $x['created'] =$created->diffForHumans();


                    $newsimages = $value_news->newsImage()->get()->toArray();
//                        dd($newsimages);
                     if(count($newsimages) > 0){
                         $x['image'] =  asset('storage/'.$newsimages[0]['news_image']);
                     }

                     else
                         {
                             $x['image'] = '';


                         }

                $x['newsImage'] = [];
                     foreach ($newsimages as $key_img => $value_img){
                      array_push($x['newsImage'],  asset('storage/'.$value_img['news_image']));
                    }

                    array_push($news,$x);

            }
            return Response::json(['code' => 200, 'status' => true,'message' => 'Data Found.','data' =>$news]);
        }
        else{
            return Response::json(['code' => 500, 'status' => false,'message' => 'No News is found write now.','data' =>array()]);
        }

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function relatedNews(Request $request){

            $temp_news = News::GetNewsByCreatedAt($request->language_id)->GetNewsByCat($request->cat_id)->orderBy('created_at' ,'desc')->take(3)->get();

         if($temp_news->count() > 0){
            $news = [];
            foreach ($temp_news as $key_news => $value_news){
                $x = $value_news->toArray();
                $created = new \Carbon\Carbon($value_news->created_at);
                $x['created'] =$created->diffForHumans();
                $newsimages = $value_news->newsImage()->get()->toArray();
                if(count($newsimages) > 0)
                    $x['image'] =  asset('storage/'.$newsimages[0]['news_image']);
                else
                    $x['image'] = '';

                $x['newsImage'] = [];
                foreach ($newsimages as $key_img => $value_img){
                    array_push($x['newsImage'],  asset('storage/'.$value_img['news_image']));
                }

                array_push($news,$x);

            }
            return Response::json(['code' => 200, 'status' => true,'message' => 'Data Found.','data' =>$news]);
        }
        else{
            return Response::json(['code' => 500, 'status' => false,'message' => 'No News is found write now.','data' =>array()]);
        }

    }

    public function forgotPassword(Request $request){

    }



}