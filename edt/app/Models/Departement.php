<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'chefDepartement'];
    public function filieres(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Filiere::class);
    }

}
