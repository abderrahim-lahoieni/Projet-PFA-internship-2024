<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enseignant;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Enseignant>
 */
class EnseignantResource extends ModelResource
{
    protected string $model = Enseignant::class;

    protected string $title = 'Enseignants';


    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Civilite', 'civilite')->required(),
            Text::make('Nom', 'nom')->required(),
            Text::make('Prenom', 'prenom')->required(),
            Text::make('Téléphone', 'tel')->required(),
            Text::make('CNE', 'cne')->required(),
            Text::make('Email', 'email')->required(),
            Text::make('Spécialité', 'specialite')->required(),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'email' => 'required|email|unique:enseignants,email,' . $item->id,
        ];
    }

    public function search(): array
    {
        return ['nom', 'prenom', 'email'];
    }
}
