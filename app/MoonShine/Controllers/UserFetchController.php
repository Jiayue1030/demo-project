<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UserFetchController extends Controller
{
    public function __invoke(): JsonResponse
    {
        dd('halo');
        return response()->json(
            User::all()
        );
    }

    //如果employee的table那里要display自己算的东西
    /**
     * 
     * 需要define一个MoonShine/Controllers/EmployeeController
     * 需要define一个index component?
     */
}
