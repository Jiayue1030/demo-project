<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProjectedLife;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;

use MoonShine\Actions\FiltersAction;
use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;
use MoonShine\Filters\SelectFilter;

use MoonShine\Decorations\Block;
use MoonShine\QueryTags\QueryTag;

class ProjectedLifeResource extends Resource
{
	public static string $model = ProjectedLife::class;

	public static string $title = 'Projected Life';

    public function indexFields(): array
    {
        return (new DictionaryIndexFields)($this);
    }

    public function formFields(): array
    {
		return [
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make(),
            Text::make('Title')->required(),
            Text::make('Slug')->required(),
        ];
    }

	public function fields(): array
	{
        /**
         * Select project (logged in users can only see the owned projects)
         * Select gender (or query tag)
         * //TODO: Need to check if 1 project got duplicate year & gender
         */
		return [
		    Block::make('', [
                ID::make()->sortable()->useOnImport(),
                Select::make('Gender', 'gender')
                    ->options([
                        'M' => 'Male',
                        'F' => 'Female'
                    ])->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Year',$field='year')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Age (x)',$field='x')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Probability of dying between exact age x and age x+1',$field='qx')
                    ->min(0)->max(1)->step(0.00000001)
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Number of survivors at exact age x',$field='lx')
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Number of deaths between exact age x and age x+1',$field='dx')
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Number of person-years lived between exact age x and age x+1',$field='l_x')
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Total person-years lived after exact age x',$field='t_x')
                    ->required()->showOnExport()->useOnImport(),
                Number::make($label = 'Expectation of life at exact age x',$field='ex')
                    ->min(0)->step(0.01)
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
        return ['id','project_id','year','gender'];
    }

    public function filters(): array
    {
        //TODO: how to filter by existing distinct year
        return [
            SelectFilter::make('Year', 'year')
                ->options([
                    'value 1' => 'Option Label 1',
                    'value 2' => 'Option Label 2'
                ])
        ];
    }

    public function queryTags(): array
    {
        return [
            QueryTag::make(
                'Male',
                static fn(Builder $q) => $q->where('gender','M')
            ),

            QueryTag::make(
                'Female',
                static fn(Builder $q) => $q->where('gender','F')
            )
        ];
    }

    public function actions(): array
    {
        return [
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
