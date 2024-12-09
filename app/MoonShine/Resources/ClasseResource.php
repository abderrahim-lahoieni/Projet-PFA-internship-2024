<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Filiere;
use App\Models\Semestre;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Classe>
 */
class ClasseResource extends ModelResource
{
    protected string $model = Classe::class;

    protected string $title = 'Classes';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Libellé', 'libelle')->required(),
                Number::make('Nombre d\'Élèves', 'nbrEleves')->required(),
                Select::make('Filière', 'filiere_id')
                    ->options(Filiere::all()->pluck('libelle', 'id')->toArray())
                    ->required(),

                Select::make('Semestre', 'semestre_id')
                    ->options(Semestre::all()->pluck('num', 'id')->toArray())
                    ->required(),
            ]),
        ];
    }

    /**
     * @param Classe $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
