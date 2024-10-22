<?php

namespace App\Http\Controllers;
use App\Models\ElementDeModule;
use App\Models\Enseignant;
use App\Http\Controllers;
use App\Models\Etudiant;
use App\Models\Semestre;
use Illuminate\Support\Facades\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        // Récupérer les éléments du module à afficher dans le calendrier
        // Passer les éléments à la vue
            $semestres = Semestre::all();
            $enseignants = Enseignant::all();
            $elements = ElementDeModule::with(['module', 'enseignant', 'salle'])->get();

            // Passer les éléments à la vue
            //return view('emploidutemps.test', compact('elements','enseignants'));
            return view('emploidutemps.index', compact('semestres', 'enseignants', 'elements'));
        }
    public function show($enseignantId)
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur est un enseignant
            // Vérifier si l'enseignant connecté essaie de voir son propre emploi du temps
            if ($user->isEnseignant() && $user->id != $enseignantId) {
                abort(403, 'Accès non autorisé à cet emploi du temps');
            }


        // Récupérer l'enseignant par son ID
        $enseignant = Enseignant::with('classes')->findOrFail($enseignantId);

        // Récupérer les éléments de module associés à cet enseignant
        $elements = ElementDeModule::where('enseignant_id', $enseignant->id)
            ->with(['module', 'salle'])
            ->get();

        // Afficher la vue spécifique pour cet enseignant avec les éléments
        return view('emploidutemps.show', compact('enseignant', 'elements'));
    }
    public function importStudents(Request $request)
    {
        $students = $request->input('students');

        if (!$students || !is_array($students)) {
            return response()->json(['message' => 'Données CSV invalides'], 400); // Bad Request
        }

        try {
            foreach ($students as $student) {
                // Vérification des champs requis dans le CSV
                if (!isset($student['nom'], $student['prenom'], $student['email'], $student['classe_id'])) {
                    return response()->json(['message' => 'Format CSV incorrect.'], 400);
                }

                // Sauvegarde dans la base de données
                Etudiant::create([
                    'nom' => $student['nom'],
                    'prenom' => $student['prenom'],
                    'email' => $student['email'],
                    'classe_id' => $student['classe_id'],
                ]);
            }

            return response()->json(['message' => 'Importation réussie']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'importation : ' . $e->getMessage()], 500); // Internal Server Error
        }
    }


    public function authorize(): bool
    {
        return  auth()->user()->isAdmin();
    }
}
