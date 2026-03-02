<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use App\Models\Judge;
use App\Enums\LevelEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TrickController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tricks = Trick::with(['judge','translations'])->get();
        return Inertia::render('tricks/Index',compact('tricks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check authorizations
        $this->authorize('create', Trick::class);

        // Render the View
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
        // Check authorizations
        $this->authorize('create', Trick::class);
        
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
        if($request->file) {
            $file = $request->file('video');
            $randomName = Str::random(12) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('videos', $randomName, 'public');
        } else {
            $path = null;
        }

        // Create new trick using validated data
        $trick = Trick::create([
            'youtube'     => $request->youtube,
            'video_url'   => $path,
            'level'       => $request->level,
            'judge_id'    => $request->judge_id
        ]);

        // Save translations
        $trick->translations()->create([
            'locale'      => app()->getLocale(),
            'name'        => $request->name,
            'description' => $request->description
        ]);

        return Inertia::location(route('tricks.index'))->with('message', __('messages.tricks.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Trick $trick)
    {
        // Render the View
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
        // Check authorizations
        $this->authorize('update', $trick);

        // Render the View
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
        // Check authorizations
        $this->authorize('update', $trick);
        
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
            'youtube'   => $request->youtube,
            'video_url' => $path,
            'level'     => $request->level,
            'judge_id'  => $request->judge_id
        ]);

        $trick->translations()->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        // Redirect back to the edit page
        return Inertia::location(route('tricks.edit',['trick' => $trick->id]))->with('message', __('messages.tricks.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trick $trick)
    {
        // Check authorizations
        $this->authorize('delete', $trick);

        // Delete the trick
        $trick->delete();

        // Redirect to the index page
        return redirect()->route('tricks.index')->with('message',__('messages.tricks.delete'));
    }
}
