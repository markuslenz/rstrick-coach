<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judge;
use Inertia\Inertia;

class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judges = Judge::latest()->get();
        return Inertia::render('judges/Index',compact('judges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('judges/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:120|unique:judges'
        ]);

        Judge::create($validatedData);

        return redirect()->route('judges.index')->with('message', 'Judge Type created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Judge $judge)
    {
        return Inertia::render('judges/Edit',compact('judge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Judge $judge)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:120'
        ]);
        $judge->update($validatedData);
        return redirect()->route('judges.edit', $judge->id)->with('message', 'Judge Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Judge $judge)
    {
        $judge->delete();
        return redirect()->route('judges.index')->with('message', 'Judge Type deleted successfully!');
    }
}
