<?php

namespace App\MoonShine\Resources;

use App\Models\Employee;
use App\Models\MoonShineUser;
use App\MoonShine\Controllers\UserFetchController;
use MoonShine\Models\MoonshineUserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

use MoonShine\FormComponents\ChangeLogFormComponent; 

use MoonShine\Decorations\Heading;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;

use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Date;
use MoonShine\Fields\Select;
use MoonShine\Resources\Resource;
use MoonShine\Actions\ExportAction;
use MoonShine\Actions\ImportAction;

class EmployeeResource extends Resource
{
    public static string $model = Employee::class;

    public static string $title = 'Employees';

    public string $titleField = 'name';

    public function fields(): array
    {
        return [
            Block::make('', [
                Tabs::make([
                    Tab::make('Information', [

                        ID::make()->sortable()->showOnExport(),
                        //TODO: 1 project can only have 1 unique staff_no
                        Text::make('Employee Name','name') 
                            ->showOnExport()->useOnImport(),
                        Text::make('Employee Num','staff_no')
                            ->required()
                            ->showOnExport()->useOnImport(),
                        Select::make('Gender','gender')
                            ->options(['M'=>'Male','F'=>'Female'])
                            ->sortable()
                            ->required()
                            ->showOnExport()->useOnImport(),
                        Date::make('Birthday', 'birthday')
                            ->format("Y-m-d")
                            ->default(now()->toDateTimeString())
                            ->sortable()
                            ->required()
                            ->showOnExport()->useOnImport(),
                        Date::make('Date of Join', 'date_of_join')
                            ->format("Y-m-d")
                            ->default(now()->toDateTimeString())
                            ->sortable()
                            ->required()
                            ->showOnExport()->useOnImport(),
                        Number::make('Monthly Income','monthly_income')
                            ->sortable()->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Bonus','bonus')
                            ->sortable()
                            ->min(0)->step(0.01)
                            ->default(0)
                            ->showOnExport()->useOnImport(),
                        Number::make('Adjusted Monthly Income','adjusted_monthly_income')
                            ->sortable()
                            ->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Monthly Wage (Basic)','monthly_wage')
                            ->sortable()
                            ->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Gratuities Paid','gratuities_paid')
                            ->sortable()->default(0)
                            ->min(0)->step(0.01)
                            ->showOnExport()->useOnImport(),                        
                        Number::make('Accrued MPF Benefits Employer\'s Contribution (Mandatory)','mandatory_mpf_benefits')
                            ->sortable()->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Accrued MPF Benefits Employer\'s Contribution (Voluntary)','voluntary_mpf_benefits')
                            ->sortable()->default(0)
                            ->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Employer Contribution for the Reporting Period','employer_contribution')
                            ->sortable()->min(0)->step(0.01)
                            ->required()->showOnExport()->useOnImport(),
                        Select::make('Department','department')
                            ->options(['SGM'=>'SGM','LKH'=>'LKH','LY'=>'LY','LKI'=>'LKI','PMT'=>'PMT'])
                            ->required()->showOnExport()->useOnImport(),
                        Number::make('Created By', 'created_by')
                            ->default(auth()->user()->id)
                            ->hideOnIndex()->hideOnDetail()
                            ->disabled()->hidden(),
                        Text::make('ipaddress', 'ipaddress')
                            ->default(request()->getClientIp())
                            ->hideOnIndex()->hideOnDetail()
                            ->disabled()->hidden(),
                    ]),
                    Tab::make('Activity Logs', [
                        Heading::make('Check Your Activty Logs'),
                    ]),
                ]),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [
        ];
    }

    public function search(): array
    {
        return ['id','name','staff_no'];
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
                ->dir('exports')
                ->queue(),

            ImportAction::make('Import')
                ->disk('public')
                ->dir('imports')
                ->deleteAfter()
                ->queue()
        ];
    }

    public function components(): array
    {
        return [
            ChangeLogFormComponent::make('Change log') 
                ->canSee(fn() => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
        ];
    }
}
