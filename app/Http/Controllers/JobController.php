<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer', 'tags'])->latest()->simplePaginate(20);

        return view('jobs.index', [
            'title' => ' Sono la pagina Jobs',
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create', [
            'title' => 'Sono la pagina create'
        ]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job,
            'title' => 'Sono la pagina singola di'
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job,
            'title' => 'Sono la pagina di edit'
        ]);
    }

    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function delete(Job $job)
    {
        $job->delete();

        return redirect('/jobs');
    }


    //converto presente su web con una funziona

    // Route::delete('/jobs/{job}', function (Job $job) {

    //     $job->delete();

    //     return redirect('/jobs');
    // });
    public function destroy()
    {}
}
