<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pillar;
use App\Models\Goal;
use App\Models\Outcome;
use App\Models\Department;
use App\Models\Activity;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create default users
        User::create([
            'name' => 'CEO User',
            'email' => 'ceo@nche.gov.mw',
            'password' => Hash::make('password'),
            'role' => 'ceo',
        ]);

        User::create([
            'name' => 'Director User',
            'email' => 'director@nche.gov.mw',
            'password' => Hash::make('password'),
            'role' => 'director',
        ]);

        User::create([
            'name' => 'Accounts User',
            'email' => 'accounts@nche.gov.mw',
            'password' => Hash::make('password'),
            'role' => 'accounts',
        ]);

        // Create sample pillar, goal, outcome, and department
        $pillar = Pillar::create([
            'name' => 'Strategic Pillar 1',
            'description' => 'Description for Strategic Pillar 1',
        ]);

        $goal = Goal::create([
            'pillar_id' => $pillar->id,
            'name' => 'Strategic Goal 1',
            'description' => 'Description for Strategic Goal 1',
        ]);

        $outcome = Outcome::create([
            'goal_id' => $goal->id,
            'name' => 'Strategic Outcome 1',
            'description' => 'Description for Strategic Outcome 1',
        ]);

        $department = Department::create([
            'outcome_id' => $outcome->id,
            'name' => 'Finance Department',
            'code' => 'FIN001',
            'description' => 'Finance and Administration Department',
        ]);

        // Create department user
        User::create([
            'name' => 'Department User',
            'email' => 'dept@nche.gov.mw',
            'password' => Hash::make('password'),
            'role' => 'department',
            'department_id' => $department->id,
        ]);

        // Create sample activity
        Activity::create([
            'department_id' => $department->id,
            'name' => 'Sample Activity',
            'description' => 'Description for sample activity',
            'budget_amount' => 100000.00,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'status' => 'in_progress',
        ]);

        $this->call(Budget2025Seeder::class);
    }
}

