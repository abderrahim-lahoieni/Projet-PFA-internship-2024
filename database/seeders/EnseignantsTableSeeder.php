<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Enseignant;

class EnseignantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $enseignants = [
            ['civilite' => 'M.', 'nom' => 'AAJLY', 'prenom' => 'Abdellah'],
            ['civilite' => 'M.', 'nom' => 'ABAKOUY', 'prenom' => 'Mostafa'],
            ['civilite' => 'M.', 'nom' => 'ABOUZAID', 'prenom' => 'Badr'],
            ['civilite' => 'Mme', 'nom' => 'ALAOUI ISMAILI', 'prenom' => 'Imane'],
            ['civilite' => 'M.', 'nom' => 'ALAMI', 'prenom' => 'Youssef'],
            ['civilite' => 'M.', 'nom' => 'AMINE', 'prenom' => 'Abderrahman'],
            ['civilite' => 'M.', 'nom' => 'AMINE', 'prenom' => 'Noureddine'],
            ['civilite' => 'Mme', 'nom' => 'AJDOUR', 'prenom' => 'Siham'],
            ['civilite' => 'M.', 'nom' => 'ATTARIUSS', 'prenom' => 'Hicham'],
            ['civilite' => 'M.', 'nom' => 'BAKOUR', 'prenom' => 'Chafik'],
            ['civilite' => 'M.', 'nom' => 'BALHADJ', 'prenom' => 'Said'],
            ['civilite' => 'M.', 'nom' => 'BELAMHITOU', 'prenom' => 'Mahmoud'],
            ['civilite' => 'M.', 'nom' => 'BELKHEIRI', 'prenom' => 'Omar'],
            ['civilite' => 'M.', 'nom' => 'BELHSEN', 'prenom' => 'Noureddine'],
            ['civilite' => 'Mme', 'nom' => 'BENAHMED', 'prenom' => 'Nora'],
            ['civilite' => 'M.', 'nom' => 'BENBBA', 'prenom' => 'Brahim'],
            ['civilite' => 'Mme', 'nom' => 'BOUFARES', 'prenom' => 'Aicha'],
            ['civilite' => 'M.', 'nom' => 'BOUJETTOU', 'prenom' => 'Hassane'],
            ['civilite' => 'Mme', 'nom' => 'BOUNGAB', 'prenom' => 'Souad'],
            ['civilite' => 'M.', 'nom' => 'CHAFIK', 'prenom' => 'Khalid'],
            ['civilite' => 'M.', 'nom' => 'CHRAIBI', 'prenom' => 'Abdeslam'],
            ['civilite' => 'M.', 'nom' => 'DAANOUNE', 'prenom' => 'Rachid'],
            ['civilite' => 'M.', 'nom' => 'EL HADDOUCHI', 'prenom' => 'Khalid'],
            ['civilite' => 'M.', 'nom' => 'EL KHALKHALI', 'prenom' => 'Imad'],
            ['civilite' => 'M.', 'nom' => 'EL KHARRAZ', 'prenom' => 'Abdelilah'],
            ['civilite' => 'Mme', 'nom' => 'ELHAMMOUD', 'prenom' => 'Anissa'],
            ['civilite' => 'M.', 'nom' => 'ELQOUR', 'prenom' => 'Tahar'],
            ['civilite' => 'M.', 'nom' => 'ETTAHRI', 'prenom' => 'Younes'],
            ['civilite' => 'Mme', 'nom' => 'GHAILAN', 'prenom' => 'Sanaa'],
            ['civilite' => 'M.', 'nom' => 'HOUSNI', 'prenom' => 'Hamid'],
            ['civilite' => 'M.', 'nom' => 'JEDLANE', 'prenom' => 'Nabil'],
            ['civilite' => 'Mme', 'nom' => 'KAISS', 'prenom' => 'Sara'],
            ['civilite' => 'M.', 'nom' => 'KORAICH', 'prenom' => 'Mehdi'],
            ['civilite' => 'M.', 'nom' => 'LAKHOUIL', 'prenom' => 'Abdellah'],
            ['civilite' => 'M.', 'nom' => 'LOUKIL', 'prenom' => 'Said'],
            ['civilite' => 'Mme', 'nom' => 'LOUMRHARI', 'prenom' => 'Rhizlane'],
            ['civilite' => 'M.', 'nom' => 'M\'BARKI', 'prenom' => 'Mohamed Amine'],
            ['civilite' => 'M.', 'nom' => 'MAGHNI', 'prenom' => 'Ahmed'],
            ['civilite' => 'M.', 'nom' => 'MAKKAOUI', 'prenom' => 'Mohamed'],
            ['civilite' => 'Mme', 'nom' => 'MARSO', 'prenom' => 'Saida'],
            ['civilite' => 'M.', 'nom' => 'MCHICH', 'prenom' => 'Rachid'],
            ['civilite' => 'M.', 'nom' => 'MOGHAR', 'prenom' => 'Adil'],
            ['civilite' => 'M.', 'nom' => 'MOUALLIM', 'prenom' => 'Issam'],
            ['civilite' => 'M.', 'nom' => 'MSSASSI', 'prenom' => 'Said'],
            ['civilite' => 'M.', 'nom' => 'RAHMOUNI', 'prenom' => 'Ahmed Fath Allah'],
            ['civilite' => 'M.', 'nom' => 'REGHIOUI', 'prenom' => 'Mohamed'],
            ['civilite' => 'Mme', 'nom' => 'RGUIOUI', 'prenom' => 'Rachida'],
            ['civilite' => 'M.', 'nom' => 'SALAHDDINE', 'prenom' => 'Abdelouhab'],
            ['civilite' => 'Mme', 'nom' => 'SEDDIKI', 'prenom' => 'Nora'],
            ['civilite' => 'Mme', 'nom' => 'TANOUTI', 'prenom' => 'Mouna'],
        ];

        foreach ($enseignants as $enseignant) {
            Enseignant::create([
                'civilite' => $enseignant['civilite'],
                'nom' => $enseignant['nom'],
                'prenom' => $enseignant['prenom'],
                'tel' => $faker->phoneNumber,
                'cne' => $faker->unique()->numerify('CNE####'),
                'email' => $faker->unique()->safeEmail,
                'specialite' => $faker->word,
            ]);
        }
    }
}
