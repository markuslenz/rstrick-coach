<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Trick;
use App\Models\Judge;
use App\Enums\LevelEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    /**
     * Display the training landing page.
     */
    public function index()
    {
        return Inertia::render('training/Index',[
            'judges' => Judge::all()
        ]);
    }

    /**
     * Display a random trick from the database.
     */
    public function show(Judge $judge=null)
    {
        // Check for Judges
        if(is_null($judge)) {
            // Get a list of 4 random tricks
            $tricks  = Trick::inRandomOrder()->limit(4)->get();
            $judgeID = null;
        } else {
            // Get a list of 4 random tricks
            $tricks  = Trick::where('judge_id', $judge->id)->inRandomOrder()->limit(4)->get();
            $judgeID = $judge->id;
        }

        // Get the first one from the random lst
        $trick = $tricks->first();

        // Shuffle the result again
        $newTricks = $tricks->shuffle();

        // Add more description
        return Inertia::render('training/Show',[
            'trick'        => $trick,
            'tricks'       => $newTricks,
            'levelOptions' => LevelEnum::options(),
            'judgeOptions' => Judge::all(),
            'judgeID'      => $judgeID,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $judgeID = is_null($request->judgeID) ? null : $request->judgeID;

        $user = Auth::user();
        $trick = Trick::with('judge')->findOrFail($request->trick_id);

        $attempt = new Attempt();

        $attempt->user_id    = $user->id;
        $attempt->trick_name = $request->trick_name;
        $attempt->judge_id   = $request->judge_id;
        $attempt->level      = $request->level;
        $attempt->trick_id   = $request->trick_id;
        
        if($trick->level === $request->level && $trick->judge_id === $request->judge_id)
        {
            $attempt->is_correct = true;
        } else {
            $attempt->is_correct = false;
        }

        $attempt->save();

        $result = Attempt::with('trick','judge')->findOrFail($attempt->id);

        return Inertia::render('training/Result',[
            'result'  => $result,
            'trick'   => $trick,
            'judgeID' => $judgeID,
        ]);
    }
}
