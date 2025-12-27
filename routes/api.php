<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home');
        Route::post('/contact', 'contact');
    });
});
