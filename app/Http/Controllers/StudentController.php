<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;


class StudentController extends Controller
{
    public function import()
    {
        Excel::import(new StudentsImport, 'students.xlsx');

        return redirect('/nova')->with('success', 'All good!');
    }

//    public function getLocation()
//    {
//        Student::select('GOVERNORATE')->get();
//    }
}
