<?php

declare(strict_types=1);

namespace App\MoonShine\IndexComponents;

use MoonShine\IndexComponents\IndexComponent;

final class WageIndexComponent extends IndexComponent
{
    public function __invoke(Resource $resource): array
    {
        return [
            Heading::make('Adopted Annual Wage Growth Rate'), 
        ];
    }
    
    // protected static string $view = 'moonshine.components.example-component';
    protected static string $view = 'wage_index.index';
}
