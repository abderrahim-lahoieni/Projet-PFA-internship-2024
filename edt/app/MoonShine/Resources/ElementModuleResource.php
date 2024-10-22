<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\ElementDeModule;
use App\Models\Enseignant;
use App\Models\Module;
use App\Models\Salle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;


/**
 * @extends ModelResource<ElementModule>
 */
class ElementModuleResource extends ModelResource
{
    protected string $model = ElementDeModule::class;

    protected string $title = 'ElementModules';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('Semestre', 'volumeHoraire')->required(),
                Text::make('Libellé', 'libelle')->required(),
                Select::make('Module', 'module_id')
                    ->options(
                        Module::orderBy('libelle', 'asc')->pluck('libelle', 'id')->toArray()
                    )
                    ->required(),
                Select::make('Enseignant', 'enseignant_id')
                    ->options(
                        Enseignant::orderBy('nom', 'asc')->pluck('nom', 'id')->toArray()
                    )
                    ->required(),
                Select::make('Salle', 'salle_id')
                    ->options(
                        Salle::orderBy('numSalle', 'asc')->pluck('numSalle', 'id')->toArray()
                    )
                    ->required(),
                Text::make('Jour', 'jour')->required(),
                Text::make('Période', 'periode')->required(),
            ]),
        ];
    }

    public function query(): Builder
    {
        return parent::query()
            ->join('modules', 'element_de_modules.module_id', '=', 'modules.id')  // Jointure avec la table 'modules'
            ->select('element_de_modules.*')  // Sélectionner les colonnes de 'element_de_modules'
            ->orderBy('modules.libelle', 'asc')  // Trier par nom de module
            ->with(['module', 'enseignant', 'salle']);  // Charger les relations nécessaires
    }

    /**
     * @param ElementDeModule $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'volumeHoraire' => 'required|integer',
            'libelle' => 'required|string|max:255',
            'module_id' => 'required|exists:modules,id',
            'enseignant_id' => 'required|exists:enseignants,id',
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
        return ['module.libelle', 'salle.numSalle', 'enseignant.nom'];
    }


}
