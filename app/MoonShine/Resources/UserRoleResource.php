<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use App\Models\UserRole;
use MoonShine\Resources\Resource;

class UserRoleResource extends Resource
{
    public static string $model = UserRole::class;

    public string $titleField = 'name';

    public static bool $withPolicy = true;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public function title(): string
    {
        return 'Roles';
    }

    public function fields(): array
    {
        return [
            Block::make('', [
                ID::make()->sortable()->showOnExport(),
                Text::make('Role Name', 'name')
                    ->required()->showOnExport(),
            ])
        ];
    }

    public function rules($item): array
    {
        return [
        ];
    }

    public function search(): array
    {
        return ['id', 'name'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make(trans('moonshine::ui.resource.role_name'), 'name'),
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
