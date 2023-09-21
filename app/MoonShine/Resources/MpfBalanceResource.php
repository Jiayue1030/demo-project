<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\MpfBalance;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Actions\FiltersAction;
use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;
use MoonShine\Decorations\Block;

class MpfBalanceResource extends Resource
{
	public static string $model = MpfBalance::class;

	public static string $title = 'MPF Balances';

	public function fields(): array
	{
		return [
		    Block::make('', [
                ID::make()->sortable()->showOnExport(),
                Number::make('Year','year')
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Select::make('Department', 'department')
                    ->options([
                        'SGM'=>'SGM',
                        'LKH'=>'LKH',
                        'LY'=>'LY',
                        'LKI'=>'LKI',
                        'PMT'=>'PMT'
                    ])->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Select::make('Type', 'type')
                    ->options([
                        'mandatory' => 'Mandatory',
                        'voluntary'=>'Voluntary'
                    ])->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make('Value','value')
                    ->min(1)->step(0.01)
                    ->sortable()
                    ->required()->showOnExport()->useOnImport(),
                Number::make('Created By', 'created_by')
                    ->default(auth()->user()->id)
                    ->hideOnIndex()->hideOnDetail()
                    ->disabled()->hidden(),
            ])];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id','year','type','value'];
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
