<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Base
{

    protected $casts = [
        'starting_date' => 'date'
    ];

    use HasFactory;
}
