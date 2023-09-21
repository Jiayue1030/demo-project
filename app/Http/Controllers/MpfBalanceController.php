<?php

namespace App\Http\Controllers;

use App\Models\MpfBalance;
use App\Http\Requests\StoreMpfBalanceRequest;
use App\Http\Requests\UpdateMpfBalanceRequest;

class MpfBalanceController extends Controller
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
     * @param  \App\Http\Requests\StoreMpfBalanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMpfBalanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MpfBalance  $mpfBalance
     * @return \Illuminate\Http\Response
     */
    public function show(MpfBalance $mpfBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MpfBalance  $mpfBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(MpfBalance $mpfBalance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMpfBalanceRequest  $request
     * @param  \App\Models\MpfBalance  $mpfBalance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMpfBalanceRequest $request, MpfBalance $mpfBalance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MpfBalance  $mpfBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MpfBalance $mpfBalance)
    {
        //
    }
}
