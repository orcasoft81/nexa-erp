<?php
use App\Core\Http\Controllers\{
    LandingController, CompanyController, AppController, ModuleController, RegisterController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/register/{module:code}', [RegisterController::class,'create'])
        ->name('register.module');

    Route::post('/register/{module:code}', [RegisterController::class,'store'])
        ->name('register.module.store');
});

Route::get('/modules', [ModuleController::class,'index'])->name('modules.index');
Route::get('/modules/{module:code}', [ModuleController::class,'show'])->name('modules.show');

Route::middleware('auth')->group(function () {

    Route::get('/companies/select', [CompanyController::class,'select'])
        ->name('companies.select');

    Route::post('/companies/select', [CompanyController::class,'setCurrent'])
        ->name('companies.setCurrent');

    Route::middleware('company.selected')->group(function () {

        Route::get('/apps', [AppController::class,'index'])->name('apps.index');

        Route::post('/modules/{module:code}/subscribe', [ModuleController::class,'subscribe'])
            ->name('modules.subscribe');
    });
});
