<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use App\Models\Judge;
use App\Enums\LevelEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'youtube'     => 'nullable|required_without:video|url:https',
            'video'       => 'nullable|required_without:youtube|file|mimes:mp4,webm,ogg|max:51200',
            'level'       => 'required',
            'judge_id'    => 'required',
            'description' => 'nullable'
        ]);

        // Handle uploaded Video
        $file = $request->file('video');
        $randomName = Str::random(12) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('videos', $randomName, 'public');

        // Create new trick using validated data
        Trick::create([
            'name'        => $request->name,
            'youtube'     => $request->youtube,
            'video_url'   => $path,
            'level'       => $request->level,
            'judge_id'    => $request->judge_id,
            'description' => $request->description

        ]);

        session()->flash('message', 'Trick created successfully!');
        return Inertia::location(route('tricks.index'));
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
            'youtube'     => 'nullable|url:https',
            'video'       => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'level'       => 'required',
            'judge_id'    => 'required',
            'description' => 'nullable'
        ]);

        // Handle uploaded Video
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $randomName = Str::random(12) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('videos', $randomName, 'public');
            // Delete old video
            $old_video = $trick->video_url;
            Storage::disk('public')->delete($old_video);
        } else {
            $path = $trick->video_url;
        }
        
        $trick->update([
            'name'        => $request->name,
            'youtube'     => $request->youtube,
            'video_url'   => $path,
            'level'       => $request->level,
            'judge_id'    => $request->judge_id,
            'description' => $request->description
        ]);

        session()->flash('message', 'Trick created successfully!');
        return Inertia::location(route('tricks.edit',['trick' => $trick->id]));
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
