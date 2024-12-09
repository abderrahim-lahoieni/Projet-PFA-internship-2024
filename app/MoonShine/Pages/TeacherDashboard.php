<?php

namespace App\MoonShine\Pages;

use App\MoonShine\components\TeacherDashboardComponent;
use MoonShine\Pages\Page;

class TeacherDashboard extends Page
{
    protected string $title = 'Tableau de bord Enseignant';

    public function components(): array
    {
        return [
            new TeacherDashboardComponent()
        ];
    }
}
