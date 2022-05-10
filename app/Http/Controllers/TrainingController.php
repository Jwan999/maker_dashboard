<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{


    public function show()
    {
//        dd(date("Y-m-d"));

        $trainings = Training::where('date', '>', date("Y-m-d"))->select('name', 'icon', 'description', 'paid', 'form_link', 'lectures', 'time', 'days', 'id')->get();
//        dd($trainings);
//        Training::where('date', '>', now())->get()
//        \Carbon\Carbon::parse($trainings->date)->format('d/m/Y')

        return json_encode($trainings);
    }
}
