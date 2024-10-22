<?php
namespace App\MoonShine\Resources;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filiere;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class FiliereResource extends ModelResource
{
    protected string $model = Filiere::class;

    protected string $title = 'Filieres';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Libellé', 'libelle'),
                Text::make('Nombre de Semestres', 'nombreSem'),
                Text::make('Chef de filière', 'chefFiliere'),
                Select::make('Département', 'departement_id')
                    ->options(Departement::all()->pluck('libelle', 'id')->toArray())
                    ->required(),

            ]),
        ];
    }

    /**
     * @param Filiere $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'libelle' => 'required|string|max:255',
            'nombreSem' => 'required|integer',
            'chefFiliere' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ];
    }
}
