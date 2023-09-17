<?php

namespace App\Providers;

use App\Models\Comment;
use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CommentResource;
use App\MoonShine\Resources\DictionaryResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\SettingResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('System', [
                MenuItem::make('Settings', new SettingResource(), 'heroicons.outline.adjustments-vertical'),
                MenuItem::make('Admins', new MoonShineUserResource(), 'heroicons.outline.users'),
                MenuItem::make('Roles', new MoonShineUserRoleResource(), 'heroicons.outline.shield-exclamation'),
            ], 'heroicons.outline.user-group')->canSee(static function () {
                return auth('moonshine')->user()->moonshine_user_role_id === 1;
            }),

            MenuItem::make('Projects', new CategoryResource(), 'heroicons.outline.document'),

            // MenuItem::make('Employees', new MoonShineUserResource(), 'heroicons.outline.users'),

            MenuGroup::make('General Information', [
                MenuItem::make('Termination Rate', new CategoryResource(), 'heroicons.outline.document'),
                MenuItem::make('Wage Index', new ArticleResource(), 'heroicons.outline.newspaper'),
                MenuItem::make('Risk Free Rate', new CategoryResource(), 'heroicons.outline.document'),
                MenuItem::make('Projected Life', new ArticleResource(), 'heroicons.outline.newspaper'),
            ], 'heroicons.outline.newspaper'),

            MenuGroup::make('Employees', [
                MenuItem::make('Employee Information', new CategoryResource(), 'heroicons.outline.users'),
                MenuItem::make('PV of LSP and Current Service Cost', new ArticleResource(), 'heroicons.outline.newspaper'),
                MenuItem::make('Current Service', new CategoryResource(), 'heroicons.outline.document'),
                MenuItem::make('Opening Balance', new ArticleResource(), 'heroicons.outline.newspaper'),
                MenuItem::make('Long-Service Payment', new CategoryResource(), 'heroicons.outline.document'),
                MenuItem::make('Employee Summary', new ArticleResource(), 'heroicons.outline.newspaper'),
            ], 'heroicons.outline.newspaper'),




            // MenuItem::make('Dictionary', new DictionaryResource(), 'heroicons.outline.document-duplicate'),

            // MenuItem::make(
            //     'Documentation',
            //     'https://moonshine.cutcode.dev',
            //     'heroicons.outline.document-duplicate'
            // )->badge(static fn() => 'New design')
        ]);
    }
}
