<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Job extends Model {
    use HasFactory;
    //serve solo se il modello non lo chiamiamo come la migrazione, in uesto caso si doveva chiamare JobListing
    protected $table = 'job_listings';
    // Specifica i campi che possono essere assegnati in modo massivo
    protected $fillable = ['title', 'salary'];

    //belongsTo ->È una relazione molti-a-uno: ad esempio, molti "Job Listings" possono appartenere a un singolo "Employer"
    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    //altre relazioni hasOne(Profile::class) cioè un record in una tabella è associato a un solo record in un'altra tabella
    //altre relazioni hasMany(Profile::class) cioè un record in una tabella è associato a molti record in un'altra tabella.

    //METODO CHE PRENDE I DATI DIRETTAMENTE DA CODICE; FISSI (non serve mettere extends Model)
        // public static function all (): array
        // {
        //     return [
        //         [  'id' => 1,
        //             'title' => 'Directory',
        //             'salary' => '$5000'
        //         ],
        //         [
        //             'id' => 2,
        //             'title' => 'Programmer',
        //             'salary' => '$2500'
        //         ],
        //         [
        //             'id' => 3,
        //             'title' => 'Ux Designer',
        //             'salary' => '$1500'
        //         ]
        //     ];
        // }

        // public static function find(int $id): array
        // {
        //    $job = Arr::first(static::all(),fn($job) => $job['id'] == $id);
        //    if(!$job){
        //         abort(404);
        //    }
        //     return $job;
        // }
}
