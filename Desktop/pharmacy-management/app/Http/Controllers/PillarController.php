<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use Illuminate\Http\Request;

class PillarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pillars = Pillar::all();
        return view('dashboard.director.pillars.index', compact('pillars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.director.pillars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Pillar::create($request->all());

        return redirect()->route('pillars.index')->with('success', 'Pillar created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pillar $pillar)
    {
        return view('dashboard.director.pillars.show', compact('pillar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pillar $pillar)
    {
        return view('dashboard.director.pillars.edit', compact('pillar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pillar $pillar)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $pillar->update($request->all());

        return redirect()->route('pillars.index')->with('success', 'Pillar updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pillar $pillar)
    {
        $pillar->delete();

        return redirect()->route('pillars.index')->with('success', 'Pillar deleted successfully.');
    }
}
