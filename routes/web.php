<?php

use App\Http\Controllers\ProfileController;
use App\Models\Job;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;


// UN ESEMPIO, MA MEGLIO USARE CLASS
//$jobs = [
//     [  'id' => 1,
//         'title' => 'Directory',
//         'salary' => '$5000'
//     ],
//     [
//         'id' => 2,
//         'title' => 'Programmer',
//         'salary' => '$2500'
//     ],
//     [
//         'id' => 3,
//         'title' => 'Ux Designer',
//         'salary' => '$1500'
//     ]
// ];
// si utilizza con use
// Route::get('/jobs', function () use($jobs) {..}

Route::get('/', function () {
    return view('home', [
        'title' => 'Sono la home',
    ]);
});

Route::get('/jobs', function () {
    return view('jobs', [
        'title' => ' Sono la pagina Jobs',
        'jobs' => Job::all()
        // 'jobs' => [
        //     [
        //         'id' => 1,
        //         'title' => 'Directory',
        //         'salary' => '$5000'
        //     ],
        //     [
        //         'id' => 2,
        //         'title' => 'Programmer',
        //         'salary' => '$2500'
        //     ],
        //     [
        //         'id' => 3,
        //         'title' => 'Ux Designer',
        //         'salary' => '$1500'
        //     ]

        // ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    // Arr::first($jobs,function($job) {
    //     return $job['id'] == $id;
    // });

    // $job=Arr::first(Job::all(),fn($job) => $job['id'] == $id);
    // dd($job);
    // array:3 [▼
    //     "id" => 1
    //     "title" => "Directory"
    //     "salary" => "$5000"
    // ]

    $job = Job::find($id);
    // $employer = $job->employer->name; AZIENDA associata all'ID

    return view('job', [
        'job' => $job,
        'title' => 'Sono la pagina singola di'
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => ' Sono la pagina contact'
    ]);
});

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

require __DIR__.'/auth.php';
