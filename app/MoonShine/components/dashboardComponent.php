<?php

namespace App\MoonShine\Components;

use MoonShine\Components\MoonShineComponent;

class DashboardComponent extends MoonShineComponent
{
    public function render(): string
    {
        return $this->view('moonshine.dashboard2')->render();
    }
}