<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
class FarmerController extends Controller
{
    public function bulkShow()
    {
        $farmer = Farmer::all();

        return view('admin.bulk-sms.create');

    }
    public function sendBulk()
    {

    }
}
