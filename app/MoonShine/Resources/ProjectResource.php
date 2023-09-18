<?php

namespace App\MoonShine\Resources;

use App\Models\Project;
use App\MoonShine\AbstractResources\SeparateResource;
use App\MoonShine\FieldSets\DictionaryFormFields;
use App\MoonShine\FieldSets\DictionaryIndexFields;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Decorations\Block;
use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Filters\TextFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Select;

class ProjectResource extends SeparateResource
{
	public static string $model = Project::class;

	public static string $title = 'Projects';

    public static bool $withPolicy = true;

    public function indexFields(): array
    {
        // return (new DictionaryIndexFields)($this);
        return [
            Block::make('', [
                ID::make()->sortable()->showOnExport(),
                Text::make(trans('moonshine::ui.resource.role_name'), 'name')
                    ->required()->showOnExport(),
            ])
        ];
    }

    public function formFields(): array
    {
        return [
            Block::make('Create A Project', [
                ID::make()->sortable()->showOnExport(),
                
                Select::make('Client', 'client_id')
                ->options([
                    'value 1' => 'Option Label 2',
                    'value 2' => 'Option Label 2'
                ]),
                Text::make('Project Name')->required()->showOnExport(),
            ])
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make(),
            Text::make('Title2')->required(),
        ];
    }

	public function rules(Model $item): array
	{
	    return [
            'title' => ['required', 'string', 'min:1'],
            'slug' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:1'],
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
