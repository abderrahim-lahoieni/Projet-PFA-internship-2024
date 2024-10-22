<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $fillable = [
        'civilite',
        'nom',
        'prenom',
        'tel',
        'cne',
        'email',
        'specialite',
    ];
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }


}
