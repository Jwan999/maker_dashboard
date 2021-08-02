<?php

use App\Models\Student;

//dd($allStudents)
$percentage = number_format((float)Student::where('governorate', 'Baghdad')->count() / Student::all()->count() * 100, 2, '.', '');

$students = Student::get()->count();

//if ($percentage == 0)
//    $percentage = 'There are no data right nowُ';

?>

<style>
    .text-4xl {
        font-size: 2.25rem;
        line-height: 2.5rem;
    }

    .mt-2 {
        margin-top: 1rem;
    }

    .w-20 {
        width: 5rem;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .justify-around {
        justify-content: space-around;
    }

    .flex {
        display: flex;
    }

    .h {
        height: 8rem;
    }
</style>
<div class="flex justify-around items-center px-4 py-6 h">
    <div>
        <h1 class="text-4xl mt-2">
            {{ $students }}
        </h1>
        <p>
            Number of students
        </p>

    </div>
    <div>
        <h1 class="text-4xl mt-2">
            {{$percentage }} %
        </h1>
        <p>
            Students from baghdad
        </p>
    </div>
</div>
