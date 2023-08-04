<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PropertyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("/owner-portal/dashboard", function () {
        return Inertia::render("OwnerPortal/Dashboard");
    })->name("dashboard");
//    Route::get("/owner-portal/my-properties", function () {
//        return Inertia::render("OwnerPortal/MyProperties");
//    })->name("my-properties");
    Route::get("/owner-portal/my-properties", [PropertyController::class, "index"])->name("my-properties");
//    Route::resource("ownedProperties", PropertyController::class);
//    Route::get("/owner-portal/owned-properties", [PropertyController::class, "index"])->name("owned-properties");

});
