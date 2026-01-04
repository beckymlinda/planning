<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\CEODashboardController;
use App\Http\Controllers\Dashboard\DirectorDashboardController;
use App\Http\Controllers\Dashboard\AccountsDashboardController;
use App\Http\Controllers\Dashboard\DepartmentDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\PillarController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BudgetItemController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Global Search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // CEO Dashboard
    Route::group(['prefix' => 'dashboard/ceo', 'middleware' => ['role:ceo']], function () {
        Route::get('/', [CEODashboardController::class, 'index'])->name('ceo.dashboard');
    });

    // Director Dashboard
    Route::group(['prefix' => 'dashboard/director', 'middleware' => ['role:director']], function () {
        Route::get('/', [DirectorDashboardController::class, 'index'])->name('director.dashboard');
        Route::post('/payments/{id}/approve', [DirectorDashboardController::class, 'approvePayment'])->name('director.approve-payment');
        Route::post('/payments/{id}/reject', [DirectorDashboardController::class, 'rejectPayment'])->name('director.reject-payment');
        Route::post('/payments/{id}/revert', [DirectorDashboardController::class, 'revertPayment'])->name('director.revert-payment');

        // Budget Management for Director
        Route::resource('pillars', PillarController::class);
        Route::resource('goals', GoalController::class);
        Route::resource('outcomes', OutcomeController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('activities', ActivityController::class);
        Route::resource('budget-items', BudgetItemController::class);
    });

    // Accounts Dashboard
    Route::group(['prefix' => 'dashboard/accounts', 'middleware' => ['role:accounts']], function () {
        Route::get('/', [AccountsDashboardController::class, 'index'])->name('accounts.dashboard');
        Route::get('/payments/create', [AccountsDashboardController::class, 'createPayment'])->name('accounts.create-payment');
        Route::get('/payments/{id}', [AccountsDashboardController::class, 'paymentDetails'])->name('accounts.payment-details');
        Route::post('/payments', [AccountsDashboardController::class, 'storePayment'])->name('accounts.store-payment');
    });

    // Department Dashboard
    Route::group(['prefix' => 'dashboard/department', 'middleware' => ['role:department']], function () {
        Route::get('/', [DepartmentDashboardController::class, 'index'])->name('department.dashboard');
        Route::get('/activities/{id}/statement', [DepartmentDashboardController::class, 'activityStatement'])->name('department.activity-statement');
    });

    // Budget Management (accessible by all authenticated users)
    Route::group(['prefix' => 'budget'], function () {
        Route::get('/departments', [BudgetController::class, 'departments'])->name('budget.departments');
        Route::get('/departments/{id}', [BudgetController::class, 'showDepartment'])->name('budget.department.show');
        Route::get('/activities', [BudgetController::class, 'activities'])->name('budget.activities');
        Route::get('/activities/{id}', [BudgetController::class, 'showActivity'])->name('budget.activity.show');
        Route::get('/budget-items', [BudgetController::class, 'budgetItems'])->name('budget.budget-items');
    });
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    switch ($user->role) {
        case 'ceo':
            return redirect()->route('ceo.dashboard');
        case 'director':
            return redirect()->route('director.dashboard');
        case 'accounts':
            return redirect()->route('accounts.dashboard');
        case 'department':
            return redirect()->route('department.dashboard');
        default:
            abort(403);
    }
})->middleware('auth')->name('dashboard');

