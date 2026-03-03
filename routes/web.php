<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [RegisterUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterUserController::class, 'store'])
        ->name('register.store');

    // Login
    Route::get('/login', [SessionsController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionsController::class, 'store'])
        ->name('login.store');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    Route::resource('ideas', IdeaController::class);

    // Steps (nested under ideas)
    Route::post('/ideas/{idea}/steps', [IdeaController::class, 'storeStep'])
        ->name('ideas.steps.store');

    Route::patch('/steps/{step}', [IdeaController::class, 'updateStep'])
        ->name('steps.update');

    Route::delete('/steps/{step}', [IdeaController::class, 'destroyStep'])
        ->name('steps.destroy');
    
    
    
    
    
    
    
    
    Route::post('/logout', [SessionsController::class, 'destroy'])
    ->name('logout');

});

