<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\RiskFreeRate;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;

use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;
use MoonShine\Filters\SelectFilter;

use MoonShine\Decorations\Block;
use MoonShine\QueryTags\QueryTag;

class RiskFreeRateResource extends Resource
{
	public static string $model = RiskFreeRate::class;

	public static string $title = 'RiskFreeRates';

	public function fields(): array
	{
        return [
		    Block::make('', [
                ID::make()->sortable()->useOnImport(),
                Number::make($label = 'Year',$field='year')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Year X',$field='year_x')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Yield (%)',$field='yield')
                    ->expansion('%')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
            ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),

            ExportAction::make('Export')
                    ->disk('public')
                    ->dir('exports')
                    ->queue(),
    
            ImportAction::make('Import')
                    ->disk('public')
                    ->dir('imports')
                    ->deleteAfter()
                    ->queue()
        ];
    }
}
