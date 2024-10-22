<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'volumeHoraire',
        'classe_id',
        'semestre_id',

    ];


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function semestre()
    {
        // Ajoutez la relation avec Semestre si nécessaire
        return $this->belongsTo(Semestre::class);
    }
}
