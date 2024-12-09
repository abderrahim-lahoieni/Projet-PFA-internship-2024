<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class ElementDeModule extends Model
{
    use HasFactory;
    public function isSalleDisponible($salleId, $jour, $periode)
    {
        // Extraire les heures de début et de fin de la nouvelle période (ex: 8h30-10h30)
        [$nouveauDebut, $nouveauFin] = explode('-', $periode);

        // Convertir les heures en timestamps pour une comparaison facile
        $nouveauDebut = \DateTime::createFromFormat('H\hi', trim($nouveauDebut))->getTimestamp();
        $nouveauFin = \DateTime::createFromFormat('H\hi', trim($nouveauFin))->getTimestamp();

        // Chercher les éléments qui utilisent la même salle et le même jour
        $conflits = ElementDeModule::where('salle_id', $salleId)
            ->where('jour', $jour)
            ->get();

        foreach ($conflits as $conflit) {
            // Extraire les heures de début et de fin de la période déjà enregistrée
            [$conflitDebut, $conflitFin] = explode('-', $conflit->periode);

            // Convertir les heures en timestamps
            $conflitDebut = \DateTime::createFromFormat('H\hi', trim($conflitDebut))->getTimestamp();
            $conflitFin = \DateTime::createFromFormat('H\hi', trim($conflitFin))->getTimestamp();

            // Vérifier s'il y a un chevauchement
            if (($nouveauDebut < $conflitFin) && ($nouveauFin > $conflitDebut)) {
                return false; // La salle est déjà réservée pendant cette période
            }
        }

        return true; // La salle est disponible
    }

    /**
     * Get the module that owns the element.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /**
     * Get the enseignant that owns the element.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class,'enseignant_id');
    }

    /**
     * Get the salle that owns the element.
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }
}
