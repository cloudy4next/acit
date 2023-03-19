<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use Xenon\LaravelBDSms\Facades\SMS;
use Illuminate\Support\Facades\Validator;

class FarmerController extends Controller
{
    public function bulkShow()
    {
        $data = Farmer::all();

        return view('admin.bulk-sms.create')->withData($data);

    }
    public function sendBulk(Request $request)
    {

        $validation = Validator::make($request->all(),[
            'message' => 'required|min:10|max:2000',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        // Subscribe then uncomment this route with adding the api key to config file SSL sms

        if($request->number[0] == 'all')
        {
           $all_number = Farmer::pluck('mobile')->toArray();
            // SMS::shoot($all_number, $request->message); //for Ssl Sms Gateway Only
             \Alert::warning('Please ask Developer for Bulk SMS Integration!')->flash();
            return redirect()->back()->withInput();
        }else{

            // SMS::shoot($request->number, $request->message); //for Ssl Sms Gateway Only
             \Alert::warning('Please ask Developer for Bulk SMS Integration!')->flash();
            return redirect()->back()->withInput();
        }

    }
}
