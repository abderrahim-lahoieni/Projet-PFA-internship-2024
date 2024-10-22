<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Salle;

use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Salle>
 */
class SalleResource extends ModelResource
{
    protected string $model = Salle::class;

    protected string $title = 'Salles';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Numéro de Salle', 'numSalle')->required(),
                Text::make('Type de Salle', 'typeSalle')->required(),
                Number::make('Capacité', 'capacite')->required(),
            ]),
        ];
    }

    /**
     * @param Salle $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'numSalle' => 'required|string|max:255',
            'typeSalle' => 'required|string|max:255',
            'capacite' => 'required|integer',
        ];
    }
}
