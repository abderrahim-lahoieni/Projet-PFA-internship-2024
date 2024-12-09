<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ElementDeModule;

class ElementsDeModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'volumeHoraire' => 2,
                'libelle' => 'G1',
                'module_id' => 49, // Remplacez par un ID valide pour votre module
                'enseignant_id' => 29, // Remplacez par un ID valide pour votre enseignant
                'salle_id' => 23, // Remplacez par un ID valide pour votre salle
                'jour' => 1,
                'periode' => '16h15-17h45'
            ],
            [
                'volumeHoraire' => 2,
                'libelle' => 'G1',
                'module_id' => 71, // Remplacez par l'ID du module approprié
                'enseignant_id' => 2, // Remplacez par l'ID de l'enseignant approprié
                'salle_id' => 16, // Remplacez par l'ID de la salle appropriée
                'jour' => 1,
                'periode' => '16h15-17h45'
            ],
            [
                'volumeHoraire' => 2,
                'libelle' => 'G1',
                'module_id' => 71, // Remplacez par l'ID du module approprié
                'enseignant_id' => 52, // Remplacez par l'ID de l'enseignant approprié
                'salle_id' => 16, // Remplacez par l'ID de la salle appropriée
                'jour' => 1,
                'periode' => '16h15-18h15'
            ],
            [
                'volumeHoraire' => 2,
                'libelle' => 'G1',
                'module_id' => 84, // Remplacez par l'ID du module approprié
                'enseignant_id' => 2, // Remplacez par l'ID de l'enseignant approprié
                'salle_id' => 28, // Remplacez par l'ID de la salle appropriée
                'jour' => 1,
                'periode' => '16h15-18h15'
            ],
        ];

        foreach ($data as $item) {
            ElementDeModule::create($item);
        }
    }
}
