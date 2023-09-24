<?php

namespace App\MoonShine\Resources;

use App\Models\User;
use App\MoonShine\Controllers\UserFetchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use MoonShine\Fields\Image;
use MoonShine\Filters\TextFilter;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Http\Controllers\PermissionController;
use MoonShine\ItemActions\ItemAction;

use MoonShine\Models\MoonshineUser;
use MoonShine\Models\MoonshineUserRole;

class UserResource extends Resource
{
    public static string $model = User::class;

    public static string $title = 'Users';

    public string $titleField = 'name';

    public function fields(): array
    {
        // return [
        //     Grid::make([
        //         Column::make([
        //             Block::make('Contact information', [
        //                 ID::make()->sortable(),
        //                 Text::make('Name'),
        //                 Email::make('E-mail', 'email'),
        //             ]),

        //             Block::make('Change password', [
        //                 Password::make('Password')
        //                     ->customAttributes(['autocomplete' => 'new-password'])
        //                     ->hideOnIndex(),

        //                 PasswordRepeat::make('Password repeat')
        //                     ->customAttributes(['autocomplete' => 'confirm-password'])
        //                     ->hideOnIndex(),
        //             ]),
        //         ]),
        //     ]),
        // ];
        return [
            Block::make('', [
                Tabs::make([
                    Tab::make('Main', [
                        ID::make()
                            ->sortable()
                            ->showOnExport(),

                        BelongsTo::make(
                            trans('moonshine::ui.resource.role'),
                            'moonshine_user_role_id',
                            new MoonShineUserRoleResource()
                        )
                            ->showOnExport(),

                        Text::make(trans('moonshine::ui.resource.name'), 'name')
                            ->required()
                            ->showOnExport(),

                        // Image::make(trans('moonshine::ui.resource.avatar'), 'avatar')
                        //     ->showOnExport()
                        //     ->disk('public')
                        //     ->dir('moonshine_users')
                        //     ->allowedExtensions(['jpg', 'png', 'jpeg', 'gif']),

                        Date::make(trans('moonshine::ui.resource.created_at'), 'created_at')
                            ->format("Y-m-d")
                            ->default(now()->toDateTimeString())
                            ->sortable()
                            ->hideOnForm()
                            ->showOnExport(),

                        Email::make(trans('moonshine::ui.resource.email'), 'email')
                            ->sortable()
                            ->showOnExport()
                            ->required(),

                        Password::make(trans('moonshine::ui.resource.password'), 'password')
                            ->customAttributes(['autocomplete' => 'new-password'])
                            ->hideOnIndex(),

                        PasswordRepeat::make(trans('moonshine::ui.resource.repeat_password'), 'password_repeat')
                            ->customAttributes(['autocomplete' => 'confirm-password'])
                            ->hideOnIndex(),
                    ]),

                    Tab::make('Change Logs', [
                        Heading::make('Check Your Activty Logs'),
                    ]),
                ]),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required',
            'email' => 'sometimes|bail|required|email|unique:users,email' . ($item->exists ? ",$item->id" : ''),
            'password' => ! $item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
        ];
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
        return [];
    }

    public function resolveRoutes(): void
    {
        parent::resolveRoutes();

        Route::get('fetch-users', UserFetchController::class)
            ->name('fetch-users');
    }
}
