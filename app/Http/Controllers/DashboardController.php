<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current user
        $user = Auth::user();

        // Get overall statistics
        $attempts_all = Attempt::where('user_id',$user->id)->count();
        $attempts_all_pass = Attempt::where(['user_id' => $user->id, 'is_correct' => true])->count();

        if($attempts_all > 0) {
            $attempts_all_pct = ($attempts_all_pass / $attempts_all) * 100;
        } else {
            $attempts_all_pct = 0;
        }

        return Inertia::render('Dashboard', [
            'attempts_all'      => $attempts_all,
            'attempts_all_pass' => $attempts_all_pass,
            'attempts_all_pct'  => number_format((float)$attempts_all_pct, 2, ',', ''),
        ]);
    }
}
