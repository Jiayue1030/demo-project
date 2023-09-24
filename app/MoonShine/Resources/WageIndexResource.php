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
use MoonShine\Metrics\ValueMetric;
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
        return $this->formFields();
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
        return $this->formFields();
    }

    public function metrics(): array 
    {
        //each project could have different wage_index...
        $end_year = now()->format('Y'); //select year(valuation_date)-1 end_year from project
        $start_year_dec_index = 0; //select index from wage_indices where type='m' and month=12 and year=$start_year_dec_index
        $addopted = 0 ; 
        return [
            ValueMetric::make('Adopted Annual Wage Growth Rate')
                ->value($addopted)
                ->valueFormat('{value}%')
        ];
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
        return [];
    }

    public function actions(): array
    {
        return [
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
