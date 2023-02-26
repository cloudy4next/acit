<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;
use App\Models\Message;

if (!function_exists('getDiagnosisCount')) {

    function getDiagnosisCount()
    {

        $user_diagnosis = Diagnosis::select("*", DB::raw("count(*) as total_mp_uid")) //message per user: mp_uid
                        ->groupBy(DB::raw("user_id"))
                        ->get('total_mp_uid');

        if($user_diagnosis != null)
        {
            foreach ($user_diagnosis as $user_d)
                {
                    Message::updateOrCreate( [
                            'title' => $user_d->title,
                            'total_messages' => $user_d->total_mp_uid,
                            'category_id' => $user_d->category_id,
                            'user_id' => $user_d->user_id,
                            ]);
                }
        }

        return $data ?? null;
    }
}
