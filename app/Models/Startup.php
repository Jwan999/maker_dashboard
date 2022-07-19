<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

class Startup extends Base
{
//    use Searchable;

    use HasFactory;

    protected $casts = [
        'started_since' => 'date'
    ];
}
