<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ModulesTableSeederphp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $modules = [
            'Informatique de base',
            'TD managt',
            'T.E.C.',
            'Microéconomie',
            'TP Info',
            'TD Compta',
            'Introduction au management',
            'Comptabilité générale 1',
            'Civilisation et cultures',
            'Anglais 1',
            'Arabe 1',
            'Mathématiques',
            'Analyse et diagnostic financiers',
            'Informatique de Gestion II',
            'Comptabilité de gestion 1',
            'Economie Internationale',
            'Eco mon et tech bancaires',
            'Probabilités-Statistiques',
            'Systèmes politiques contemporains',
            'Arabe économique',
            'TD Diag. Fin / MOGHAR',
            'TD Comptabilité de Gest',
            'Anglais commercial',
            'Arabe économique',
            'EPS',
            'Systèmes politiques contemporains',
            'Anglais commercial',
            'Anglais des affaires',
            'Simulation',
            'Compta Approfondie',
            'Marketing territorial',
            'Marketing des services',
            'Méthodologie et comm',
            'GRH II',
            'Gestion de portefeuille',
            'Espagnol des affaires',
            'Gest financière internat',
            'Marketing industriel',
            'Management Interculturel',
            'Recherche opérationnelle',
            'Anglais des affaires 3',
        ];
        sort($modules);
        foreach ($modules as $module) {
            Module::create([
                'libelle' => $module,
                'volumeHoraire' => $faker->numberBetween(20, 60), // Exemple : entre 20 et 60 heures
                'classe_id' => $faker->numberBetween(1, 5), // Exemple : ID de classe entre 1 et 5
                'semestre_id' => $faker->numberBetween(1, 2), // Exemple : Semestre 1 ou 2
            ]);
        }
    }
}
