<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Base
{
    use HasFactory;

    protected $casts = [
        'employment_date' => 'date'
    ];
}
