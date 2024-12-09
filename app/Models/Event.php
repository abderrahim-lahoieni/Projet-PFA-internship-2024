<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'jour',      // Nouveau champ
        'periode',   // Nouveau champ
        'salle_id',
    ];

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    /**
     * Vérifie si la salle est disponible pour un événement donné
     *
     * @param int $salleId
     * @param string $jour
     * @param string $periode
     * @return bool
     */

    public static function isSalleDisponible($salleId, $jour, $periode): bool
    {
        // Vérification dans les événements
        $eventConflict = self::where('salle_id', $salleId)
            ->where('jour', $jour)
            ->where('periode', $periode)
            ->exists();

        // Vérification dans les éléments de module
        $moduleConflict = ElementDeModule::where('salle_id', $salleId)
            ->where('jour', $jour)
            ->where('periode', $periode)
            ->exists();

        // Retourne false si un conflit est trouvé dans l'une des deux tables
        return !($eventConflict || $moduleConflict);
    }


}
