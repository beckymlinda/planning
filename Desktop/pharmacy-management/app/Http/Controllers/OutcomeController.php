<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Goal;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcomes = Outcome::with('goal.pillar')->get();
        return view('dashboard.director.outcomes.index', compact('outcomes'));
    }

    public function create()
    {
        $goals = Goal::with('pillar')->get();
        return view('dashboard.director.outcomes.create', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_id' => 'required|exists:goals,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Outcome::create($request->all());

        return redirect()->route('director.outcomes.index')->with('success', 'Outcome created successfully.');
    }

    public function show(Outcome $outcome)
    {
        $outcome->load('goal.pillar', 'departments');
        return view('dashboard.director.outcomes.show', compact('outcome'));
    }

    public function edit(Outcome $outcome)
    {
        $goals = Goal::with('pillar')->get();
        return view('dashboard.director.outcomes.edit', compact('outcome', 'goals'));
    }

    public function update(Request $request, Outcome $outcome)
    {
        $request->validate([
            'goal_id' => 'required|exists:goals,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $outcome->update($request->all());

        return redirect()->route('director.outcomes.index')->with('success', 'Outcome updated successfully.');
    }

    public function destroy(Outcome $outcome)
    {
        $outcome->delete();

        return redirect()->route('director.outcomes.index')->with('success', 'Outcome deleted successfully.');
    }
}
