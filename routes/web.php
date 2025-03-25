<?php

use App\Http\Controllers\RegisteredUserController;
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
Route::view('/contact', 'contact', ['title' => 'Sono la pagina contact']);

//jobs
//1
// Route::get('/jobs', [JobController::class,'index']);
// Route::get('/jobs/create',[JobController::class,'create']);
// Route::get('/jobs/{job}',[JobController::class,'show']);
// Route::post('/jobs',[JobController::class,'store']);
// Route::get('/jobs/{job}/edit',[JobController::class,'edit']);
// Route::patch('/jobs/{job}',[JobController::class,'update']);
// Route::delete('/jobs/{job}',[JobController::class,'delete']);

//v2
// Route::controller(JobController::class)->group(function(){
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

//resource fa tutto in automatico bisogna sempre usare questa convenzione  index/create/show/store/edit/update/destroy.
Route::resource('jobs', JobController::class);

//resource scritto come sopra le crea sempre tutte, ma in certi casi ci servono solo alcune
// Route::resource('jobs', JobController::class, [
//     possiamo usare o only o except
//     'only' => [],
//     'except' => ['edit'],
// ]);

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
