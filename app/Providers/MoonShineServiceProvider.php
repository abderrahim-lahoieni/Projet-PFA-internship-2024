<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\ClasseResource;
use App\MoonShine\Resources\DepartementResource;
use App\MoonShine\Resources\ElementDeModuleResource;
use App\MoonShine\Resources\ElementModuleResource;
use App\MoonShine\Resources\EnseignantResource;
use App\MoonShine\Resources\EventResource;
use App\MoonShine\Resources\FiliereResource;
use App\MoonShine\Resources\ModuleResource;
use App\MoonShine\Resources\SalleResource;
use App\MoonShine\Resources\SemestreResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [
        ];
    }

    /**
     * @return list<Page>
     */

    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('Admin'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource(),
                    'heroicons.user-plus'
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
                ]),
            MenuGroup::make(static fn() => __('Menu'), [
                MenuItem::make(
                    static fn() => __('Enseignants'),
                    new EnseignantResource() // Assurez-vous que c'est une instance de la ressource
                     ,'heroicons.academic-cap'
                ),

                MenuItem::make(
                    static fn() => __('Departements'),
                    new DepartementResource() ,// Assurez-vous que c'est une instance de la ressource
                    'heroicons.square-3-stack-3d'
                ),
                MenuItem::make(
                    static fn() => __('Filieres'),
                    new FiliereResource(),// Assurez-vous que c'est une instance de la ressource
                    'heroicons.outline.briefcase',
                ),
                MenuItem::make('Semestres', new SemestreResource(),'heroicons.outline.calendar-days'),
                MenuItem::make('Classes', new ClasseResource(),'heroicons.user-group'),
                MenuItem::make('Salles',new SalleResource(),'heroicons.window'),
                MenuItem::make('Modules',new ModuleResource(),'heroicons.outline.pencil'),
                MenuItem::make('Elements_Module',new ElementModuleResource(),'heroicons.outline.pencil-square'),
                MenuItem::make('Events',new EventResource(),'heroicons.outline.pencil-square'),

            ]),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
