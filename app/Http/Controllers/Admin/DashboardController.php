<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosis;
use App\Models\Notice;
use App\Models\Post;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Tutorial;

class DashboardController extends Controller
{

        public function dashboard(Request $request)
    {
        $farmer = Farmer::count();
        $diagnosis = Diagnosis::count();
        $notice = Notice::count();
        $post  = Post::count();
        $tutorial = Tutorial::count();
        $user = User::where('email','not like', "%@acitdream%")->count();

       return view(
            'vendor.backpack.base.admin_dashboard',
            [
                'farmer' => $farmer,
                'diagnosis' => $diagnosis,
                'notice' => $notice,
                'post' => $post,
                'tutorial' => $tutorial,
                'user' => $user,
            ]
        );
    }

}
