<?php

namespace App\Http\Controllers;

use App\Models\ProjectedLife;
use App\Http\Requests\StoreProjectedLifeRequest;
use App\Http\Requests\UpdateProjectedLifeRequest;

class ProjectedLifeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectedLifeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectedLifeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectedLife  $projectedLife
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectedLife $projectedLife)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectedLife  $projectedLife
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectedLife $projectedLife)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectedLifeRequest  $request
     * @param  \App\Models\ProjectedLife  $projectedLife
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectedLifeRequest $request, ProjectedLife $projectedLife)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectedLife  $projectedLife
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectedLife $projectedLife)
    {
        //
    }
}
