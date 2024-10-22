<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function importCSV(Request $request)
    {
        $data = $request->all();

        try {
            foreach ($data as $studentData) {
                // Vérifier si l'étudiant existe déjà
                $etudiant = Etudiant::updateOrCreate(
                    ['email' => $studentData['email']], // Utiliser l'email pour vérifier l'existence
                    [
                        'nom' => $studentData['nom'],
                        'prenom' => $studentData['prenom'],
                        'classe_id' => $studentData['classe_id']
                    ]
                );
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
