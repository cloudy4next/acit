<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Diagnosis;
use App\Models\ELearning;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MarketPrice;
use App\Models\Notice;
use App\Models\Tutorial;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DiagnosisApiController extends Controller
{


    public function userInfo(Request $request)
    {
        $data = User::with('farmer')->where('id', Auth::user()->id)->first();
        $user_data = [];
        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        $user_data[] = [
            'id' => $data->id,
            'name' => $data->name,
            'image' => url('uploads/farmer/' . $data->farmer->image),
            'mobile' => $data->farmer->mobile,
            'address' => $data->farmer->address,
            'profession' => $data->farmer->profession,

        ];


        return response(['message' => 'success', 'data' => $user_data], 200);
    }

    public function getCategory()
    {

        $data = Category::all();

        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        return response(['message' => 'success', 'count' => $data->count(), 'data' => $data], 200);
    }

    public function attachmentStore($attachments, $path): string
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
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|min:6',
            'category_id' => 'required|integer',
            'description' => 'required|string|min:6|',
            'audio' => 'mimes:mp4',
            'image' => 'image',
            'lat' => 'required|string',
            'long' => 'required|string',

        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()->all()], 422);
        }

        if ($request->image != NULL) {
            $image_filename = $this->attachmentStore($request->image, 'image');
        }
        if ($request->audio != NULL) {
            $audio_filename = $this->attachmentStore($request->audio, 'audio');
        }

        $diagnosis = new Diagnosis();
        $diagnosis->title = $request['title'];
        $diagnosis->description = $request['description'];
        $diagnosis->category_id = $request['category_id'];
        $diagnosis->user_id = Auth::user()->id;
        $diagnosis->created_at = Carbon::now();
        $diagnosis->image = $image_filename ?? NULL;
        $diagnosis->audio = $audio_filename ?? NULL;
        $diagnosis->lat = $request['lat'];
        $diagnosis->long = $request['long'];

        $diagnosis->save();
        return response(['message' => 'Diagnosis Send Successfully'], 200);
    }


    public function getDiagnosis(Request $request)
    {

        $data = Diagnosis::where('user_id', Auth::user()->id)->get();
        $diagnosis = [];
        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach ($data as $diagnosis_data) {
            $diagnosis[] = [
                'title' => $diagnosis_data->title,
                'description' => $diagnosis_data->description,
                'image' => url('uploads/diagnosis/image/' . $diagnosis_data->image),
                'audio' => url('uploads/diagnosis/audio/' . $diagnosis_data->audio),
                'response_text' => $diagnosis_data->response_text,
                'category_id' => $diagnosis_data->category_id,

            ];
        }

        return response(['message' => 'success', 'count' => $data->count(), 'data' => $diagnosis], 200);
    }

    // Being lazy, i implemented all function's on this Controller !!!

    public function getPost($id)
    {
        // dd($id);

        $data = Post::where('category_id', $id)->get();
        $post = [];

        foreach ($data as $post_data) {
            $post[] = $this->postResponse($post_data);
        }

        if ($data->count() == 0) {
            $response = ['error' => 'No Resource Found!'];

            return response($response, 404);
        }

        return response(['message' => 'success', 'count' => $data->count(), 'data' => $post], 200);
    }

    public function getNotice()
    {
        $data = Notice::where('notice_period', '>=', Carbon::now())->get();
        $notice = [];

        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach ($data as $notice_data) {
            $notice[] = $this->noticeResponse($notice_data);
        }
        return response(['message' => 'success', 'count' => $data->count(), 'data' => $notice], 200);
    }

    public function getMarketInfo()
    {
        $data = MarketPrice::all();
        $market = [];

        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach ($data as $market_data) {
            $market[] = $this->marketResponse($market_data);
        }
        return response(['message' => 'success', 'count' => $data->count(), 'data' => $market], 200);
    }

    public function getTutorial($id)
    {

        // dd($id);
        $data = Tutorial::where('category_id', $id)->get();
        $tutorial = [];

        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach ($data as $tutorial_data) {
            $tutorial[] = $this->tutorialResponse($tutorial_data);
        }
        return response(['message' => 'success', 'count' => $data->count(), 'data' => $tutorial], 200);
    }


    // all response type, thus i'm not interested to use  ResourceCollection

    public function marketResponse($market_data): array
    {
        return [
            'name' => $market_data->name,
            'amount' => $market_data->amount,
        ];
    }

    public function postResponse($post): array
    {
        return [
            'title' => $post->title,
            // 'category' => $post->category,
            'image' => url('uploads/post/' . $post->image),
            'description' => $post->description,
            'created_at' => $post->created_at,
        ];
    }

    public function tutorialResponse($tutorial): array
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $tutorial->url, $matches);

        return [
            'title' => $tutorial->title,
            'description' => $tutorial->description,
            'url' => $matches[1],
            'created_at' => $tutorial->created_at,
        ];
    }


    public function noticeResponse($notice_data): array
    {
        return [
            'title' => $notice_data->title,
            'description' => $notice_data->description,
            'notice_period' => $notice_data->notice_period,
            'created_at' => $notice_data->created_at,

        ];
    }



    public function elearning()
    {
        $data = ELearning::all();
        $elearning = [];

        if ($data->count() == 0) {
            return response(['error' => 'No Resource Found!'], 404);
        }

        foreach ($data as $e_data) {
            $elearning[] = $this->elearningResponse($e_data);
        }
        return response(['message' => 'success', 'count' => $data->count(), 'data' => $elearning], 200);
    }

    public function elearningResponse(object $eData): array
    {
        return [
            'title' => $eData->title,
            'description' => $eData->description,
            'category_id' => $eData->category_id,
            'image' => 'uploads/e_learning/' . $eData->images,
            'created_at' => $eData->created_at,
        ];
    }

    public function elearningSingleCat(Request $request)
    {
        $childParent = Category::where('category_id', $request->id)
        ->where('parent_id', $request->id)->get()->toArray();

        $data = ELearning::whereIn('category_id', $childParent)->get();

        $e_data = [];

        if ($data->count() == 0) {
            return response(['error' => 'Noting Found!'], 404);
        }

        foreach ($data as $e_cat) {
            $e_data[] = $this->elearningResponse($e_cat);
        }

        return response(['message' => 'success', 'count' => $data->count(), 'data' => $e_data], 200);
    }

    public function elearningSingle(Request $request)
    {
        $searchTeam = $request->q;

        $data = ELearning::where('category_id', $request->category)
            ->where('title', 'LIKE', '%' . $searchTeam . '%')
            ->orwhere('description', 'LIKE', '%' . $searchTeam . '%')->get();
        $e_data = [];

        if ($data->count() == 0) {
            return response(['error' => 'Noting Found!'], 404);
        }

        foreach ($data as $e_cat) {
            $e_data[] = $this->elearningResponse($e_cat);
        }

        return response(['message' => 'success', 'count' => $data->count(), 'data' => $e_data], 200);
    }
}
