<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Trick;
use App\Models\Judge;
use App\Enums\LevelEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display the training landing page.
     */
    public function index()
    {

    }

    /**
     * Display a random trick from the database.
     */
    public function show()
    {
        return Inertia::render('training/Show',[
            'trick' => Trick::inRandomOrder()->first(),
            'levelOptions' => LevelEnum::options(),
            'judgeOptions' => Judge::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $trick = Trick::with('judge')->findOrFail($request->trick_id);

        $attempt = new Attempt();

        $attempt->user_id    = $user->id;
        $attempt->trick_name = $request->trick_name;
        $attempt->judge_id   = $request->judge_id;
        $attempt->level      = $request->level;
        
        if($trick->level === $request->level && $trick->judge_id === $request->judge_id)
        {
            $attempt->is_correct = true;
        } else {
            $attempt->is_correct = false;
        }

        $attempt->save();

        $result = Attempt::with('trick','judge')->findOrFail($attempt->id);

        return Inertia::render('training/Result',[
            'result' => $result,
            'trick'  => $trick,
        ]);
    }
}
