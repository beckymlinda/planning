<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BudgetItem;
use App\Models\Activity;
use Illuminate\Http\Request;

class BudgetItemController extends Controller
{
    public function index($activityId)
    {
        $budgetItems = BudgetItem::where('activity_id', $activityId)->get();
        return response()->json($budgetItems);
    }

    public function store(Request $request, $activityId)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $amount = $request->quantity * $request->unit_price;

        $budgetItem = BudgetItem::create([
            'activity_id' => $activityId,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'amount' => $amount,
        ]);

        return response()->json($budgetItem, 201);
    }

    public function update(Request $request, $id)
    {
        $budgetItem = BudgetItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $amount = $request->quantity * $request->unit_price;

        $budgetItem->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'amount' => $amount,
        ]);

        return response()->json($budgetItem);
    }

    public function destroy($id)
    {
        $budgetItem = BudgetItem::findOrFail($id);
        $budgetItem->delete();

        return response()->json(['message' => 'Budget item deleted successfully']);
    }
}

