<?php

namespace App\MoonShine\Resources;

use App\Models\Employee;
use App\MoonShine\Controllers\UserFetchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;

class EmployeeResource extends Resource
{
    public static string $model = Employee::class;

    public static string $title = 'Employees';

    public string $titleField = 'name';

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make('Contact information', [
                        ID::make()->sortable(),
                        Text::make('Name'),
                        Email::make('E-mail', 'email'),
                    ]),

                    Block::make('Change password', [
                        Password::make('Password')
                            ->customAttributes(['autocomplete' => 'new-password'])
                            ->hideOnIndex(),

                        PasswordRepeat::make('Password repeat')
                            ->customAttributes(['autocomplete' => 'confirm-password'])
                            ->hideOnIndex(),
                    ]),
                ]),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required',
            'email' => 'sometimes|bail|required|email|unique:Employees,email' . ($item->exists ? ",$item->id" : ''),
            'password' => ! $item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
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
        return [];
    }

    public function resolveRoutes(): void
    {
        parent::resolveRoutes();

        Route::get('fetch-Employees', EmployeeFetchController::class)
            ->name('fetch-Employees');
    }
}
