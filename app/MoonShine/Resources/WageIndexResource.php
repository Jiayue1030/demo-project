<?php

namespace App\MoonShine\Resources;

use App\MoonShine\AbstractResources\SeparateResource;

use Illuminate\Database\Eloquent\Model;
use App\Models\WageIndex;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Flex;

use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;
use MoonShine\Actions\FiltersAction;
use MoonShine\Filters\SelectFilter;
use app\MoonShine\Resources\WageIndexResource;
use App\MoonShine\FieldSets\WageIndexIndexFields;
use App\MoonShine\IndexComponents\WageIndexComponent;

class WageIndexResource extends SeparateResource
{
	public static string $model = WageIndex::class;

	public static string $title = 'Wage Index';

    public function indexFields():array {
        return (new WageIndexIndexFields)($this);
    }

    public function formFields():array {
        return [
            Block::make('', [
                ID::make()->sortable()->showOnExport(),
                Flex::make([
                    Number::make('Year','year')->min(2000)->step(1)
                        ->required()->sortable()->showOnExport()->useOnImport(),
                    Select::make('Month','month')
                        ->options([
                            3 => 'Mar',
                            6=> 'Jun',
                            9=> 'Sep',
                            12=> 'Dec'
                        ])
                        ->required()->sortable()->searchable()->showOnExport()->useOnImport(),
                    Select::make('Type','type')
                        ->options([
                            'm'=>'Manufacturing',
                            'i'=>'Import/export, wholesale and retail trades',
                            't'=>'Transportation',
                            'a'=>'Accommodation and food service activities ^',
                            'fi'=>'Financial and insurance activities',
                            're'=>'Real estate leasing and maintenance management',
                            'pb'=>'Professional and business services',
                            'ps'=>'Personal services',
                            'all'=>'All selected industry sections #'
                        ])
                        ->required()->sortable()->searchable()->showOnExport()->useOnImport(),
                ]),
                Number::make('Index','index')->min(0.01)->step(0.01)
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make('Created By', 'created_by')
                    ->default(auth()->user()->id)
                    ->hideOnIndex()->hideOnDetail()
                    ->disabled()->hidden(),
            ])];
    }

    public function detailFields():array {
        return (new ExampleDetailComponent)($this);
    }

	public function rules(Model $item): array
	{
	    return [
        ];
    }

    public function search(): array
    {
        return ['id','type'];
    }

    public function filters(): array
    {
        return ['type','year','month','index'];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
            ExportAction::make('Export')
                ->disk('public')
                ->dir('exports')->showInLine()
                ->queue(),

            ImportAction::make('Import')
                ->disk('public')
                ->dir('imports')
                ->deleteAfter()->showInLine()
                ->queue()
        ];
    }
}
