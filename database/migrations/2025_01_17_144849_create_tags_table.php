<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    /*Quando usare una tabella pivot?
    Quando esiste una relazione molti-a-molti tra due entità.
    Ad esempio:
    Un lavoro può avere molti tag (es. "Remote", "Full-time").
    Un tag può essere associato a molti lavori. */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        /*
        $table->foreignIdFor(\App\Models\Job::class, 'job_listing_id')

        Crea una colonna chiamata job_listing_id nella tabella in cui è definita la migrazione.
        Questa colonna rappresenta la chiave esterna che punta alla chiave primaria del modello Job.
        È un'implementazione semplificata per creare chiavi esterne e viene mappata automaticamente alla colonna id nella tabella associata (di default, jobs).

        ->constrained()

        Specifica che questa colonna è una chiave esterna.
        Laravel utilizza il nome del modello (Job) per dedurre il nome della tabella (jobs).
        Imposta la relazione come chiave esterna con riferimento automatico alla colonna id della tabella jobs.

        ->cascadeOnDelete()

        Specifica che, quando un record nella tabella jobs viene eliminato, tutti i record nella tabella corrente (che hanno questa chiave esterna) devono essere eliminati automaticamente.
        Questo implementa il comportamento CASCADE ON DELETE a livello di database.

        Nome composto dai nomi dei modelli in ordine alfabetico (job_tag in questo caso).
        Due colonne per memorizzare le chiavi esterne:
        job_id (collegata alla tabella jobs).
        tag_id (collegata alla tabella tags).
        */
        Schema::create('job_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Job::class,'job_listing_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('job_tag');
    }
};
