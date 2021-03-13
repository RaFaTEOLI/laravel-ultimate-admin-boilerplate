<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersRoleController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["prefix" => "admin", "middleware" => ["role:admin"]], function () {
    Route::get("/users", [UserController::class, 'index'])
        ->name("users")
        ->middleware("permission:read-users");

    Route::get("/user", function () {
        return view("admin/user/user");
    })
        ->name("users.new")
        ->middleware("permission:read-users");

    Route::get("/user/{id}", [UserController::class, 'show'])
        ->name("users.show")
        ->middleware("permission:read-users");

    Route::delete("/user/{id}", [UserController::class, 'destroy'])
        ->name("users.destroy")
        ->middleware("permission:delete-users");

    Route::post("/users", [UserController::class, 'store'])
        ->name("users.store")
        ->middleware("permission:create-users");

    Route::put("/users/{id}", [UserController::class, 'update'])
        ->name("users.update")
        ->middleware("permission:update-users");

    Route::patch("/users/{userId}/role/{roleId}", [UsersRoleController::class, 'store'])
        ->name("users.role")
        ->middleware("permission:update-users");

    Route::delete("/users/{userId}/role/{roleId}", [UsersRoleController::class, 'destroy'])
        ->name("users.role.remove")
        ->middleware("permission:update-users");
});
