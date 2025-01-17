<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {

    public static function all (): array
    {
        return [
            [  'id' => 1,
                'title' => 'Directory',
                'salary' => '$5000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$2500'
            ],
            [
                'id' => 3,
                'title' => 'Ux Designer',
                'salary' => '$1500'
            ]
        ];
    }

    public static function find(int $id): array
    {
       $job = Arr::first(static::all(),fn($job) => $job['id'] == $id);
       if(!$job){
            abort(404);
       }
        return $job;
    }
}
