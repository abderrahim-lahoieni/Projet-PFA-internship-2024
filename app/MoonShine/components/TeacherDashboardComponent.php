<?php

namespace App\MoonShine\components;

use MoonShine\Components\MoonShineComponent;

class TeacherDashboardComponent extends MoonShineComponent
{

    public function render(): string
    {
        return $this->view('moonshine.teacher_dashboard')->render();
    }
}
