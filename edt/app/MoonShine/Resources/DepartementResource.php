<?php
namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;

use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Departement>
 */
class DepartementResource extends ModelResource
{
    protected string $model = Departement::class;

    protected string $title = 'Departements';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Libellé', 'libelle'),
                Text::make('Chef de département', 'chefDepartement'),
            ]),
        ];
    }

    /**
     * @param Departement $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
