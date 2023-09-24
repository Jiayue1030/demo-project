<?php

declare(strict_types=1);

namespace App\MoonShine\FieldSets;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\Resource;

final class WageIndexIndexFields
{
    public function __invoke(Resource $resource): array
    {
        return [
            // Heading::make(),
            // Number::make('Year'),
            // Select::make('Month')
            //     ->options([
            //         3 => 'Mar',
            //         6=> 'Jun',
            //         9=> 'Sep',
            //         12=> 'Dec'
            //     ]),
            // Select::make('Type')->options([
            //     'm'=>'Manufacturing',
            //     'i'=>'Import/export, wholesale and retail trades',
            //     't'=>'Transportation',
            //     'a'=>'Accommodation and food service activities ^',
            //     'fi'=>'Financial and insurance activities',
            //     're'=>'Real estate leasing and maintenance management',
            //     'pb'=>'Professional and business services',
            //     'ps'=>'Personal services',
            //     'all'=>'All selected industry sections #'
            // ]),
            // Number::make('Index')
        ];
    }
}
