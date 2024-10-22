<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = ['libelle', 'nbrEleves', 'filiere_id', 'semestre_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    // Relation avec l'enseignant
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
