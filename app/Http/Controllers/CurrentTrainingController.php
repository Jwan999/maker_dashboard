<?php

namespace App\Http\Controllers;

use App\Models\CurrentTraining;
use Illuminate\Http\Request;

class CurrentTrainingController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CurrentTraining $currentTraining
     * @return \Illuminate\Http\Response
     */
    public function show(CurrentTraining $currentTraining)
    {
        $currentTrainings = CurrentTraining::all();
        return json_encode($currentTrainings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CurrentTraining $currentTraining
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrentTraining $currentTraining)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CurrentTraining $currentTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurrentTraining $currentTraining)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CurrentTraining $currentTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrentTraining $currentTraining)
    {
        //
    }
}
