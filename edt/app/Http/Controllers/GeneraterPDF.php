<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\ElementDeModule;
use App\Models\Enseignant;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class GeneraterPDF extends Controller
{
    public function index() {

        $jours = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi'
        ];

        $heures = ['8h30-10h','8h30-10h30', '10h15-11h45','10h15-12h45','10h45-12h15','10h45-12h45', '14h-16h', '14h30-16h','16h15-17h45'];

        $seances = [
            'Séance 1' => ['8h30-10h', '8h30-10h30'],
            'Séance 2' => ['10h15-11h45', '10h15-12h45', '10h45-12h15', '10h45-12h45'],
            'Séance 3' => ['14h-16h', '14h30-16h'],
            'Séance 4' => ['16h15-17h45']
        ];
        $semestre=request('semestre');
        if($semestre ==8 ||$semestre ==9  ) {
            $groupes = ['ACG','GFC','MRH','MLT','MARK','CI'];
        }
        else{
            $groupes = ['G1','G2','G3','G4','G5','G6'];
        }
        $emploiDuTemps = [];
        $heureAvantH = ['8','10','14','16'];

        foreach ($jours as $jourNumero => $jourNom) {
            foreach ($groupes as $groupe) {
                foreach ($heureAvantH as $heure) {
                    $element = ElementDeModule::where('jour', $jourNumero)
                        ->where(DB::raw('SUBSTRING_INDEX(periode, "h", 1)'), $heure)
                        ->where('libelle', $groupe)
                        ->where('volumeHoraire', $semestre)
                        ->first();

                   // dd($element);
                    // Si l'élément existe et a un module associé, obtenir le libelle du module
                    $moduleLibelle = 'Aucun cours';
                    $prof ='';
                    $salle ='';
                    if ($element && $element->module && $element->enseignant) {
                    $moduleLibelle = $element->module->libelle;
                    $prof=$element->enseignant->nom;
                    $salle=$element->salle->numSalle;
                    }
                    //$emploiDuTemps = [];
                    if ($element){
                    $periode = $element->periode;
                    }else{
                        $periode =null;
                    }
                    $pr[$jourNom][$groupe][$heure] = $periode;
                    $emploiDuTemps[$jourNom][$groupe][$heure] = $moduleLibelle;
                    $profs[$jourNom][$groupe][$heure] = $prof;
                    $salles[$jourNom][$groupe][$heure] = $salle;
                }
            }
        }



        $tab=[];

        foreach ($jours as $jourNumero => $jourNom) {
            foreach ($groupes as $groupe) {
                foreach ($heureAvantH as $heure) {
                    $element = ElementDeModule::where('jour', $jourNumero)
                        ->where(DB::raw('SUBSTRING_INDEX(periode, "h", 1)'), $heure)
                        ->where('libelle', $groupe)
                        ->where('volumeHoraire', $semestre)
                        ->first();
                        if ($element && $element->module && $element->enseignant) {
                    $tab[] =  $element->module->libelle.'+'.$element->enseignant->nom.'+'.$pr[$jourNom][$groupe][$heure].'+'.$jourNom;
                        }
                }}}




                $compteur = []; // Tableau de comptage des occurrences

                // Boucle pour compter les occurrences
                foreach ($tab as $t) {
                    if (isset($compteur[$t])) {
                        $compteur[$t]++;
                    } else {
                        $compteur[$t] = 1;
                    }
                }
                $IsPdf=true;

                $gr=$groupes;
                return Pdf::loadView('emploidutemps.test', compact('pr','emploiDuTemps','profs','salles','tab','compteur','IsPdf','semestre','gr'))->setPaper([0, 0, 3000, 3500], 'landscape')->stream('S'.$semestre.'.pdf');
    }
}
