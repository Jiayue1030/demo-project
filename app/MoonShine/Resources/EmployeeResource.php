<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use MoonShine\Actions\ExportAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Http\Controllers\PermissionController;
use MoonShine\ItemActions\ItemAction;
use App\Models\Employee;
use MoonShine\Models\MoonshineUserRole;
use MoonShine\Resources\Resource;

class EmployeeResource extends Resource
{
    public static string $model = Employee::class;

	public static string $title = 'Employee';

    public string $titleField = 'title';

    public static bool $withPolicy = true;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public static array $with = ['employee'];

    public static string $orderField = 'sorting';

    public function treeKey(): ?string
    {
        return 'employee_id';
    }

    public function sortKey(): string
    {
        return 'sorting';
    }

	public function fields(): array
	{
		return [
            Block::make('', [
                ID::make()->sortable(),
                BelongsTo::make('Employee')
                    ->nullable(),
                Text::make('Name')->required(),
            ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'title' => ['required', 'string', 'min:5'],
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Employee')
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
