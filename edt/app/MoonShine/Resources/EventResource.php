<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Salle;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use Illuminate\Validation\ValidationException;

/**
 * @extends ModelResource<Event>
 */
class EventResource extends ModelResource
{
    protected string $model = Event::class;

    protected string $title = 'Events';



    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Title', 'title')->required(),
            Text::make('Description', 'description'),
            Text::make('Jour', 'jour')->required(),  // Nouveau champ
            Text::make('Période', 'periode')->required(),  // Nouveau champ
            Select::make('Salle', 'salle_id')
                ->options(Salle::pluck('numSalle', 'id')->toArray())
                ->required(),
        ];
    }



    public function rules(Model $item): array
    {
        return [
            'title' => 'required|string|max:255',
            'salle_id' => [
                'required',
                'exists:salles,id',
                function($attribute, $value, $fail) use ($item) {
                    $jour = request('jour');
                    $periode = request('periode');

                    // Vérification de la disponibilité de la salle
                    if (!$item->isSalleDisponible($value, $jour, $periode)) {
                        $fail('Cette salle est déjà réservée pour la période sélectionnée.');
                    }
                },
            ],
            'jour' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
        ];
}


    public function search(): array
    {
        return ['title', 'jour', 'periode'];
    }

}
