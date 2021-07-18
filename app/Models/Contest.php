<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Base
{
    use HasFactory;

    protected $casts = [
        'date' => 'date'
    ];
}
