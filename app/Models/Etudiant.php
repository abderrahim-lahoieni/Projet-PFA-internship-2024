<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'email', 'classe_id'];

    // Relation avec la classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
