<?php

declare(strict_types=1);

namespace App\MoonShine\FieldSets;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\Resource;

final class WageIndexIndexFields
{
    public function __invoke(Resource $resource): array
    {
        return [
            Heading::make('Adopted Annual Wage Growth Rate'), 
        ];
    }
}
