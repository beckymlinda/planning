<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'activities', 'middleware' => ['auth:api']], function () {
    Route::get('{activityId}/budget-items', 'Api\BudgetItemController@index');
    Route::post('{activityId}/budget-items', 'Api\BudgetItemController@store');
    Route::put('budget-items/{id}', 'Api\BudgetItemController@update');
    Route::delete('budget-items/{id}', 'Api\BudgetItemController@destroy');
});

