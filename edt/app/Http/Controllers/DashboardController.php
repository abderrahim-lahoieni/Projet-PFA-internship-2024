<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Departement;
use App\Models\Enseignant;
use App\Models\Salle;

class DashboardController extends Controller
{
    public function index()
    {
        $classesCount = Classe::count();
        $enseignantsCount = Enseignant::count();
        $sallesCount = Salle::count();
        $departementsCount = Departement::count();

        return view('statistiques', compact('classesCount', 'enseignantsCount', 'sallesCount', 'departementsCount'));
    }
}