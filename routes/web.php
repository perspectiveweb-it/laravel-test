<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Models\Job;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('home', [
//         'title' => 'Sono la home',
//     ]);
// });

//scrittura breve se dobbiamo solo far vedere una pagina, solitamente pagine statiche
Route::view('/', 'home', ['title' => 'Sono la home']);

//jobs
Route::get('/jobs', [JobController::class,'index']);
Route::get('/jobs/create',[JobController::class,'create']);
Route::get('/jobs/{job}',[JobController::class,'show']);
Route::post('/jobs',[JobController::class,'store']);
Route::get('/jobs/{job}/edit',[JobController::class,'edit']);
Route::patch('/jobs/{job}',[JobController::class,'update']);
Route::delete('/jobs/{job}',[JobController::class,'delete']);

Route::view('/contact', 'contact', ['title' => 'Sono la pagina contact']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
