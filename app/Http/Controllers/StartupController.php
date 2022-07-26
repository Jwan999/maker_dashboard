<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Product;
use App\Models\Startup;
use App\Models\Student;
use App\Models\Training;
use Illuminate\Http\Request;

class StartupController extends Controller
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

    public function getModelsNumbers()
    {
        $trainings = Training::count();
        $products = Product::count();
        $students = Student::count();
        $interns = Intern::count();
        $startups = Startup::count();

        $data = [
            'trainings' => $trainings,
            'products' => $products,
            'students' => $students,
            'interns' => $interns,
            'startups' => $startups,
        ];

        return $data;


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
     * @param \App\Models\Startup $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup)
    {
        $startups = Startup::all();
        return json_encode($startups);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Startup $startup
     * @return \Illuminate\Http\Response
     */
    public function edit(Startup $startup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Startup $startup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startup $startup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Startup $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup)
    {
        //
    }
}
