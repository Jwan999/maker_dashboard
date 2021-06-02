<?php

use App\Models\Intern;

//dd($allStudents)

$interns = Intern::get()->count()

//if ($percentage == 0)
//    $percentage = 'There are no data right nowُ';

?>

<style>
    .margin {
        margin: 25px
    }
</style>
<p class="margin">
    Number of interns</p>
<h1 class="margin">
    {{ $interns }}
</h1>
