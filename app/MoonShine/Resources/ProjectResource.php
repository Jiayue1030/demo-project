<?php

namespace App\MoonShine\Resources;

use App\Models\Project;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\AbstractResources\SeparateResource;
use App\MoonShine\FieldSets\DictionaryFormFields;
use App\MoonShine\FieldSets\DictionaryIndexFields;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
// use MoonShine\Fields\TinyMce;
use MoonShine\Fields\BelongsTo; 

use MoonShine\Filters\TextFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Select;
use MoonShine\Decorations\Flex;

class ProjectResource extends SeparateResource
{
	public static string $model = Project::class;

	public static string $title = 'Projects';

    public static bool $withPolicy = true;

    public function indexFields(): array
    {
        // return (new DictionaryIndexFields)($this);
        return [
            Text::make('Project Title', 'name'),
            Text::make('Valuation Target','valuation_target'),
            Text::make('Ref Num','ref_num'),
            Date::make('Valuation Date','valuation_date'),
        ];
    }

    public function formFields(): array
    {
        return [
            Block::make('', [
                ID::make()->sortable()->showOnExport(),
                //TODO: figure out how to select users account with is_client flag..
                Select::make('Client','client_id')
                    ->options(
                        [4=>'Client A',5=>'Client B']
                    )->required()->showOnExport(),
                Text::make('Project Title', 'name')
                    ->required()->showOnExport(),
                Text::make('Valuation Target','valuation_target')
                    ->default('Long Service Payment Valuation')
                    ->required()->showOnExport(),
                Text::make('Ref Num','ref_num')
                    ->nullable()->showOnExport(),
                Date::make('Valuation Date','valuation_date')
                    ->default(now()->toDateTimeString())
                    ->showOnExport(),
                Flex::make([
                    Number::make('Sum Long Service Payment','sum_long_service_payment')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                    Number::make('Max Long Service Payment','max_long_service_payment')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                    Number::make('Max Monthly Employer Contribution','max_monthly_employer_contribution')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                ]),
                Flex::make([
                    Number::make('Net Annual Return MPF Asset','net_annual_return_mpfasset')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                    Number::make('Discount Rate','discount_rate')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                    Number::make('Wage Growth','wage_growth')
                        ->min(1)->step(0.01)
                        ->nullable()->showOnExport(),
                ]),
                
                Enum::make('Status','status')->options([
                    'disabled'=>'Disabled',
                    'ongoing'=>'Ongoing',
                    'done'=>'Done'])
                    ->default('ongoing')->showOnExport(),
                
                Number::make('Created By', 'created_by')
                    ->default(auth()->user()->id)
                    ->hideOnIndex()->hideOnDetail()
                    ->disabled()->hidden(),
                Text::make('ipaddress', 'ipaddress')
                    ->default(request()->getClientIp())
                    ->hideOnIndex()->hideOnDetail()
                    ->disabled()->hidden(),
            ])
        ];
        return [];
    }

    public function detailFields(): array
    {
        return [
            // ID::make(),
            // Text::make('Title2')->required(),
        ];
    }

	public function rules(Model $item): array
	{
	    return [
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Title')
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
