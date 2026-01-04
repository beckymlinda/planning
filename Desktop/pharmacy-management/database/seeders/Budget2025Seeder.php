<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Pillar;
use App\Models\Goal;
use App\Models\Outcome;
use App\Models\Activity;
use App\Models\BudgetItem;

class Budget2025Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create departments
        $corporate = Department::create([
            'outcome_id' => null, // Will set later
            'name' => 'Corporate Section',
            'code' => '300',
            'description' => 'Corporate governance and administration',
        ]);

        $audit = Department::create([
            'outcome_id' => null,
            'name' => 'Internal Audit Section',
            'code' => '301', // Changed to avoid duplicate
            'description' => 'Internal audit and risk management',
        ]);

        $ceo = Department::create([
            'outcome_id' => null,
            'name' => 'OFFICE OF THE CEO',
            'code' => '290',
            'description' => 'Chief Executive Officer office',
        ]);

        // Pillar 1
        $pillar1 = Pillar::create([
            'name' => 'Governance and Management',
            'description' => 'Pillar 1: Governance and Management',
        ]);

        // Goal 1
        $goal1 = Goal::create([
            'pillar_id' => $pillar1->id,
            'name' => 'To improve oversight at Council level',
            'description' => 'Goal 1: To improve oversight at Council level',
        ]);

        // Outcome 1
        $outcome1 = Outcome::create([
            'goal_id' => $goal1->id,
            'name' => 'Improved decision making and coordination',
            'description' => 'Outcome 1: Improved decision making and coordination',
        ]);

        // Update departments with outcome_id
        $corporate->update(['outcome_id' => $outcome1->id]);
        $audit->update(['outcome_id' => $outcome1->id]);
        $ceo->update(['outcome_id' => $outcome1->id]);

        // Activities for Corporate Section
        $councilMeetings = Activity::create([
            'department_id' => $corporate->id,
            'name' => 'Council meetings',
            'code' => '3000',
            'budget_amount' => 79205504.00, // From the total
        ]);

        // Budget items for Council meetings
        BudgetItem::create([
            'activity_id' => $councilMeetings->id,
            'name' => 'Sitting allowances-chair',
            'unit_of_measure' => 'Each',
            'quantity' => 1,
            'frequency' => 5,
            'unit_cost' => 80000.00,
            'total' => 400000.00,
        ]);

        BudgetItem::create([
            'activity_id' => $councilMeetings->id,
            'name' => 'Sitting allowances-members',
            'unit_of_measure' => 'Each',
            'quantity' => 12,
            'frequency' => 5,
            'unit_cost' => 70000.00,
            'total' => 4200000.00,
        ]);

        // Add more budget items as needed...

        // Similarly for other activities

        // Pillar 4 for Audit
        $pillar4 = Pillar::create([
            'name' => 'FINANCIAL MANAGEMENT AND SUSTAINABILITY',
            'description' => 'PILLAR 4: FINANCIAL MANAGEMENT AND SUSTAINABILITY',
        ]);

        $goal2 = Goal::create([
            'pillar_id' => $pillar4->id,
            'name' => 'To improve the budgetary and management control systems',
            'description' => 'Goal 2: To improve the budgetary and management control systems',
        ]);

        $outcome2 = Outcome::create([
            'goal_id' => $goal2->id,
            'name' => 'Management control systems operational',
            'description' => 'Management control systems operational',
        ]);

        // Update audit department
        $audit->update(['outcome_id' => $outcome2->id]);

        // Activities for Audit
        $externalAudit = Activity::create([
            'department_id' => $audit->id,
            'name' => 'Facilitate procurement of external and general IT audit services.',
            'code' => '3500',
            'budget_amount' => 9680000.00,
        ]);

        BudgetItem::create([
            'activity_id' => $externalAudit->id,
            'name' => 'External Audit fees',
            'unit_of_measure' => 'Fees',
            'quantity' => 1,
            'frequency' => 1,
            'unit_cost' => 9680000.00,
            'total' => 9680000.00,
        ]);

        // Add more as needed...
    }
}
