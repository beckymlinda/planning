<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use App\Models\Goal;
use App\Models\Outcome;
use App\Models\Department;
use App\Models\Activity;
use App\Models\BudgetItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return view('search.results', [
                'query' => $query,
                'results' => collect(),
                'total' => 0
            ]);
        }

        $results = collect();

        // Search Pillars
        $pillars = Pillar::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->with('goals')
                        ->get()
                        ->map(function ($item) {
                            return [
                                'type' => 'Pillar',
                                'title' => $item->name,
                                'description' => $item->description,
                                'url' => auth()->user()->role === 'director' ? route('pillars.show', $item) : '#',
                                'meta' => $item->goals->count() . ' goals'
                            ];
                        });

        // Search Goals
        $goals = Goal::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->with('pillar', 'outcomes')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'type' => 'Goal',
                            'title' => $item->name,
                            'description' => $item->description,
                            'url' => auth()->user()->role === 'director' ? route('goals.show', $item) : '#',
                            'meta' => $item->pillar->name . ' | ' . $item->outcomes->count() . ' outcomes'
                        ];
                    });

        // Search Outcomes
        $outcomes = Outcome::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->with('goal.pillar', 'departments')
                          ->get()
                          ->map(function ($item) {
                              return [
                                  'type' => 'Outcome',
                                  'title' => $item->name,
                                  'description' => $item->description,
                                  'url' => auth()->user()->role === 'director' ? route('outcomes.show', $item) : '#',
                                  'meta' => $item->goal->name . ' | ' . $item->departments->count() . ' departments'
                              ];
                          });

        // Search Departments
        $departments = Department::where('name', 'LIKE', "%{$query}%")
                                ->orWhere('code', 'LIKE', "%{$query}%")
                                ->orWhere('description', 'LIKE', "%{$query}%")
                                ->with('outcome.goal.pillar', 'activities', 'users')
                                ->get()
                                ->map(function ($item) {
                                    return [
                                        'type' => 'Department',
                                        'title' => $item->name . ' (' . $item->code . ')',
                                        'description' => $item->description,
                                        'url' => route('budget.department.show', $item),
                                        'meta' => $item->outcome->name . ' | ' . $item->activities->count() . ' activities'
                                    ];
                                });

        // Search Activities
        $activities = Activity::where('name', 'LIKE', "%{$query}%")
                             ->orWhere('code', 'LIKE', "%{$query}%")
                             ->orWhere('description', 'LIKE', "%{$query}%")
                             ->with('department.outcome.goal.pillar', 'budgetItems')
                             ->get()
                             ->map(function ($item) {
                                 return [
                                     'type' => 'Activity',
                                     'title' => $item->name . ' (' . $item->code . ')',
                                     'description' => $item->description,
                                     'url' => route('budget.activity.show', $item),
                                     'meta' => $item->department->name . ' | MWK ' . number_format($item->budget_amount, 2) . ' | ' . $item->status
                                 ];
                             });

        // Search Budget Items
        $budgetItems = BudgetItem::where('name', 'LIKE', "%{$query}%")
                                ->orWhere('description', 'LIKE', "%{$query}%")
                                ->with('activity.department')
                                ->get()
                                ->map(function ($item) {
                                    return [
                                        'type' => 'Budget Item',
                                        'title' => $item->name,
                                        'description' => $item->description,
                                        'url' => route('budget.budget-items') . '#item-' . $item->id,
                                        'meta' => $item->activity->name . ' | MWK ' . number_format($item->total, 2)
                                    ];
                                });

        // Search Payments
        $payments = Payment::where('payee', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->with('activity.department', 'user')
                          ->get()
                          ->map(function ($item) {
                              return [
                                  'type' => 'Payment',
                                  'title' => $item->payee,
                                  'description' => $item->description,
                                  'url' => auth()->user()->role === 'accounts' ? route('accounts.payment-details', $item->id) : '#',
                                  'meta' => $item->activity->name . ' | MWK ' . number_format($item->amount, 2) . ' | ' . $item->status
                              ];
                          });

        // Search Users
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->with('department')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'type' => 'User',
                            'title' => $item->name,
                            'description' => $item->email,
                            'url' => '#',
                            'meta' => $item->role . ($item->department ? ' | ' . $item->department->name : '')
                        ];
                    });

        // Combine all results
        $results = $pillars->concat($goals)->concat($outcomes)->concat($departments)
                          ->concat($activities)->concat($budgetItems)->concat($payments)->concat($users);

        $total = $results->count();

        return view('search.results', compact('query', 'results', 'total'));
    }
}
