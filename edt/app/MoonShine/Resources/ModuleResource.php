<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Classe;
use App\Models\Semestre;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Module>
 */
class ModuleResource extends ModelResource
{
    protected string $model = Module::class;

    protected string $title = 'Modules';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Libellé', 'libelle'),
                Number::make('Volume Horaire', 'volumeHoraire'),
                Select::make('Classe', 'classe_id')
                    ->options(Classe::all()->pluck('libelle', 'id')->toArray())
                    ->required(),
                Select::make('Semestre', 'semestre_id')
                    ->options(Semestre::all()->pluck('num', 'id')->toArray())
                    ->required(),
            ]),
        ];
    }

    /**
     * @param Module $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'libelle' => 'required|string|max:255',
            'volumeHoraire' => 'required|integer',
            'classe_id' => 'required|exists:classes,id',
            'semestre_id' => 'required|exists:classes,id',
        ];
    }
    public function search(): array
    {
        return ['libelle','classe.libelle'];
    }

}
