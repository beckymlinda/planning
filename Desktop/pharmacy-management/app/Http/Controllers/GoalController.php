<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Pillar;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::with('pillar')->get();
        return view('dashboard.director.goals.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pillars = Pillar::all();
        return view('dashboard.director.goals.create', compact('pillars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pillar_id' => 'required|exists:pillars,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Goal::create($request->all());

        return redirect()->route('goals.index')->with('success', 'Goal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        $goal->load('pillar', 'outcomes');
        return view('dashboard.director.goals.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal)
    {
        $pillars = Pillar::all();
        return view('dashboard.director.goals.edit', compact('goal', 'pillars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'pillar_id' => 'required|exists:pillars,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $goal->update($request->all());

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
