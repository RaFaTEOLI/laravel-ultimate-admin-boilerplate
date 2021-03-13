<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RolesPermissionController;

/*
|--------------------------------------------------------------------------
| Roles Routes
|--------------------------------------------------------------------------
|
*/
/**
 * Admin Middleware
 */
Route::group(["prefix" => "admin", "middleware" => ["role:admin"]], function () {
    Route::get("/roles", [RolesController::class, 'index'])
        ->name("roles")
        ->middleware("permission:read-roles");

    Route::get("/role", function () {
        return view("admin/role/role");
    })->name("roles.new");

    Route::get("/role/{id}", [RolesController::class, 'show'])
        ->name("roles.show")
        ->middleware("permission:read-roles");

    Route::delete("/role/{id}", [RolesController::class, 'destroy'])
        ->name("roles.destroy")
        ->middleware("permission:delete-roles");

    Route::post("/roles", [RolesController::class, 'store'])
        ->name("roles.store")
        ->middleware("permission:create-roles");

    Route::put("/roles/{id}", [RolesController::class, 'update'])
        ->name("roles.update")
        ->middleware("permission:update-roles");

    Route::patch("/roles/{roleId}/permission/{permissionId}", [RolesPermissionController::class, 'store'])
        ->name("roles.permission.update")
        ->middleware("permission:update-roles");

    Route::delete("/roles/{roleId}/permission/{permissionId}", [RolesPermissionController::class, 'destroy'])
        ->name("roles.permission.remove")
        ->middleware("permission:delete-roles");
});
