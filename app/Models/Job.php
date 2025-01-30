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
    protected $fillable = ['title', 'salary','employer_id'];
    // protected $guarded = []; non protteggo nessun dato, non serve dichiarare fillable

    //belongsTo ->È una relazione molti-a-uno: ad esempio, molti "Job Listings" possono appartenere a un singolo "Employer"
    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    //belongsToMany Un record in un modello può essere associato a più record di un altro modello e viceversa.
    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey:"job_listing_id");
    }

    // Esempio di scenario
    // Immaginiamo che tu stia creando un'app per gestire offerte di lavoro (Job) e tag (Tag).

    // Tabelle:
    // jobs: contiene le informazioni sulle offerte di lavoro.
    // tags: contiene i tag (ad esempio "Full-time", "Remote").
    // job_tag: una tabella pivot che collega jobs e tags.


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
