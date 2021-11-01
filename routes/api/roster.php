<?php

use App\Http\Controllers\RosterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersRoleController;

/*
|--------------------------------------------------------------------------
| Roster Routes
|--------------------------------------------------------------------------
|
*/

Route::group(["middleware" => "auth:sanctum"], function () {
    // Route::get("rosters/{id}", [RosterController::class, 'show']);
    Route::get("rosters", [RosterController::class, 'index']);
    Route::post("rosters", [RosterController::class, 'store']);
});
