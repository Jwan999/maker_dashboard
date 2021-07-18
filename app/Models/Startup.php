<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Base
{
    use HasFactory;

    protected $casts = [
        'started_since' => 'date'
    ];
}
