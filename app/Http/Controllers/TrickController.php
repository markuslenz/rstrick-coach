<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use App\Models\Judge;
use App\Enums\LevelEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TrickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tricks = Trick::with('judge')->get();
        return Inertia::render('tricks/Index',compact('tricks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('tricks/Create', [
            'levelOptions' => LevelEnum::options(),
            'judgeOptions' => Judge::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If validation passes, the data is automatically validated
        $validatedData = $request->validate([
            'name'        => 'required|string|max:120|unique:tricks',
            'url'         => 'required|url:https',
            'level'       => 'required',
            'judge_id'    => 'required',
            'description' => 'nullable'
        ]);

        // Create new trick using validated data
        Trick::create($validatedData);

        return redirect()->route('tricks.index')->with('message', 'Trick created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trick $trick)
    {
        return Inertia::render('tricks/Show',[
            'trick' => $trick,
            'judge' => Judge::findOrFail($trick->judge_id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trick $trick)
    {
        return Inertia::render('tricks/Edit',[
            'trick' => $trick,
            'levelOptions' => LevelEnum::options(),
            'judgeOptions' => Judge::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trick $trick)
    {
        // If validation passes, the data is automatically validated
        $validatedData = $request->validate([
            'name'        => 'required|string|max:120',
            'url'         => 'required|url:https',
            'level'       => 'required',
            'judge_id'    => 'required',
            'description' => 'nullable'
        ]);
        
        $trick->update($validatedData);

        return redirect()->route('tricks.edit', $trick->id)->with('message', 'Trick updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trick $trick)
    {
        $trick->delete();
        return redirect()->route('tricks.index')->with('message','Trick deleted successfully!');
    }
}
