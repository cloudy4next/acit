<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MarketPrice;
use App\Models\Notice;
use App\Models\Tutorial;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DiagnosisApiController extends Controller
{

     public function attachmentStore($attachments,$path) : string
    {
        $destinationPath = public_path() . "/uploads/diagnosis/" . $path;
        $name = $attachments->getClientOriginalName();
        $fileName = time() . '_' . $name;
        $fileName = preg_replace('/\s+/', '_', $fileName);
        $attachments->move($destinationPath, $fileName);

        return $fileName;
    }

    public function storeDiagnosis(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'title' => 'required|string|min:6',
            'category_id' => 'required|integer|min:6|',
            'description' => 'required|string|min:6|',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'audio' => 'required|mimes:mp3,wav',

        ]);

        if($validation->fails()){

            return response(['errors'=>$validation->errors()->all()], 422);

        }

        if ($request->image != NULL) {
            $image_filename = $this->attachmentStore($request->image,'image');
        }
        if ($request->audio != NULL) {
            $audio_filename = $this->attachmentStore($request->audio,'audio');
        }

        $diagnosis = new Diagnosis();
        $diagnosis->title = $request['title'];
        $diagnosis->description = $request['description'];
        $diagnosis->category_id = $request['category_id'];
        $diagnosis->user_id = backpack_user()->id;
        $diagnosis->created_at = Carbon::now();
        $diagnosis->image = $image_filename ?? NULL;
        $diagnosis->audio = $audio_filename ?? NULL;
        $diagnosis->save();

        return response(['message'=>'Diagnosis Send Successfully'], 200);

    }


    public function getDiagnosis(Request $request)
    {
        $data = Diagnosis::where('user_id', $request->id)->get();
        $diagnosis = [];
        if($data->count() == 0)
        {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach($data as $diagnosis_data)
        {
            $diagnosis[] = [
                    'title' =>$diagnosis_data->title,
                    'description' =>$diagnosis_data->description,
                    'image' =>$diagnosis_data->image,
                    'audio' =>$diagnosis_data->audio,
                    'response_text' =>$diagnosis_data->response_text,
                    'category' =>$diagnosis_data->category,

            ];

        }

        return response(['message'=>'success','count'=> $data->count(),'data'=>$diagnosis], 200);


    }

  // Being lazy, i implemented all function's on this Controller !!!

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

     public function getNotice()
    {
        $data = Notice::where('notice_period','>=' ,Carbon::now())->get();
        $notice = [];

        if($data->count() == 0)
        {
            return response(['error' => 'No Resource Found!'], 404);

        }

        foreach($data as $notice_data)
        {
            $notice[] = $this->noticeResponse($notice_data);

        }
        return response(['message'=>'success','count'=> $data->count(),'data'=>$notice], 200);
    }

    public function getMarketInfo()
    {
        $data = MarketPrice::all();
        $market = [];

        if($data->count() == 0)
        {
            return response(['error' => 'No Resource Found!'], 404);

        }

        foreach($data as $market_data)
        {
            $market[] = $this->marketResponse($market_data);

        }
        return response(['message'=>'success','count'=> $data->count(),'data'=>$market], 200);

    }

    public function getTutorial()
    {
        $data = Tutorial::all();
        $tutorial = [];

        if($data->count() == 0)
        {
            return response(['error' => 'No Resource Found!'], 404);

        }

        foreach($data as $tutorial_data)
        {
            $tutorial[] = $this->marketResponse($tutorial_data);

        }
        return response(['message'=>'success','count'=> $data->count(),'data'=>$tutorial], 200);

    }


    // all response type, thus i'm not interested to use  ResourceCollection

    public function marketResponse($market_data) : array
    {
            return  [
                    'name' => $market_data->name,
                    'amount' => $market_data->amount,
            ];
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

    public function tutorialResponse($tutorial) : array
    {
            return  [
                    'title' => $tutorial->title,
                    'category' => $tutorial->category,
                    'url' => $tutorial->url,
            ];
    }


    public function noticeResponse($notice_data) : array
    {
            return  [
                    'title' => $notice_data->title,
                    'description' => $notice_data->description,
                    'notice_period' => $notice_data->notice_period,
            ];
    }

}
