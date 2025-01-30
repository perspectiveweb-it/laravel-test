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


//problemi prestazioni, se noi passiamo direttamente alla vista 'jobs' => Job::all() questa lanciera una query per ogni jobs
//soluzione $jobs = Job::with(['employer'])->get();
Route::get('/jobs', function () {
    // $jobs = Job::with(['tags', 'employer'])->select('id', 'title', 'salary')->get(); con get() li prende tutti

    //paginate(3) paginate vista classica però il calcolo delle pagine potrebbe comportare problemi di prestazioni se ci sono miglioni elementi
    //simplePaginate(3); simple paginate avrà solo torna indietro o vai avanti
    //cursorPaginate  più performante di tutte, ma non crea delle vere e proprie pagina ma url casuali per passare alle pagine precendenti e successive quindi se voglio vedere i risultati di pagina 12 non posso.
    $jobs = Job::with(['employer','tags'])->latest()->simplePaginate(20);

    return view('jobs.index', [
        'title' => ' Sono la pagina Jobs',
        'jobs' => $jobs

        // 'jobs' => Job::all()

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

//Rotta per creare con un form un nuovo lavoro, deve essere sopra a quello del singolo jobs sennò mi da un errore perchè pensa che create sia un parametro id
Route::get('/jobs/create', function () {
    return view('jobs.create',[
            'title' => 'Sono la pagina create'
    ]);
});

//Rotta per vedere il singolo jobs

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

    return view('jobs.show', [
        'job' => $job,
        'title' => 'Sono la pagina singola di'
    ]);
});

//per il form bisogna creare un route con POST
Route::post('/jobs',function(){
    /* dd(request()->all());
    array:3 [▼ // routes/web.php:106
        "_token" => "r7uMHHOn3gtda6lN0ttuPBXsFUHFdzPBiRqV9nXg"
        "title" => "Lorem"
        "salary" => "$30,000 per anno"
        ]
    dd(request('title'))  restituisce il titolo
    */

    request()->validate([
        'title' => ['required','min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);
    return redirect('/jobs');
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
