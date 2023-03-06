<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MarketPrice;
class DiagnosisApiController extends Controller
{
    public function getPost()
    {
        $data = Post::all();
        $post = [];


        foreach($data as $post_data)
        {
            $post[] = $this->postResponse($post_data);

        }

        if($data->count() == 0)
        {
            $response = ['error' => 'No Resource Found!'];

            return response($response, 404);
        }

        return response(['message'=>'success','count'=> $data->count(),'data'=>$post], 200);

    }

    public function postResponse($post) : array
    {
            return  [
                    'title' => $post->title,
                    'category' => $post->category,
                    'image' => $post->image,
                    'description' => json_encode($post->description),
            ];
    }


    public function getMarketInfo()
    {
        $data = MarketPrice::all();
        $market = [];

        if($data->count() == 0)
        {
            $response = ['error' => 'No Resource Found!'];

            return response($response, 404);
        }

        foreach($data as $market_data)
        {
            $market[] = $this->marketResponse($market_data);

        }
        return response(['message'=>'success','count'=> $data->count(),'data'=>$market], 200);

    }

    public function marketResponse($market_data) : array
    {
            return  [
                    'name' => $market_data->name,
                    'amount' => $market_data->amount,
            ];
    }
}
