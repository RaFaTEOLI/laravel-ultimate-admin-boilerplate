<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Permissions Routes
|--------------------------------------------------------------------------
|
*/
/**
 * Admin Middleware
 */
Route::group(["prefix" => "admin", "middleware" => ["role:admin"]], function () {
    Route::get("/permissions", [PermissionController::class, 'index'])
        ->name("permissions")
        ->middleware("permission:read-permissions");

    Route::get("/permission", function () {
        return view("admin/permission/permission");
    })
        ->name("permissions.new")
        ->middleware("permission:create-permissions");

    Route::get("/permission/{id}", [PermissionController::class, 'show'])
        ->name("permissions.show")
        ->middleware("permission:create-permissions");

    Route::delete("/permission/{id}", [PermissionController::class, 'destroy'])
        ->name("permissions.destroy")
        ->middleware("permission:delete-permissions");

    Route::post("/permissions", [PermissionController::class, 'store'])
        ->name("permissions.store")
        ->middleware("permission:create-permissions");

    Route::put("/permissions/{id}", [PermissionController::class, 'update'])
        ->name("permissions.update")
        ->middleware("permission:update-permissions");
});
