<?php

use App\Models\Trainer;

//dd($allStudents)

$trainers = Trainer::get()->count()

//if ($percentage == 0)
//    $percentage = 'There are no data right nowُ';

?>

<style>
    .margin {
        margin: 25px
    }
</style>
<p class="margin">
    Number of trainers</p>
<h1 class="margin">
    {{$trainers }}
</h1>
