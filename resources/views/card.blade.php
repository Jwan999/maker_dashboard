<?php

use App\Models\Student;

//dd($allStudents)

$percentage = number_format((float) Student::where('governorate', 'Baghdad')->count() / Student::all()->count() * 100, 2, '.', '')

//if ($percentage == 0)
//    $percentage = 'There are no data right nowُ';

?>

<style>
    .margin {
        margin: 25px
    }
</style>

<h1 class="margin">
    {{$percentage }} %
</h1>
<p class="margin">
    Of our students from Baghdad
</p>