<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Semestre;

use MoonShine\Fields\Date;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Semestre>
 */
class SemestreResource extends ModelResource
{
    protected string $model = Semestre::class;

    protected string $title = 'Semestres';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
            ID::make()->sortable(),
            Date::make('Date de Début', 'dateDebut')->required(),
            Date::make('Date de Fin', 'dateFin')->required(),
            Text::make('Numéro', 'num')->required(),
            Text::make('Année Universitaire', 'anneeUniv')->required(),
        ])
            ];
    }

    /**
     * @param Semestre $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
