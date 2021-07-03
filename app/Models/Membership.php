<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',

    ];

    public function student()
    {
        return $this->belongsTo(Student::class);

    }

    public function getIsActiveAttribute()
    {
        $now = Carbon::now()->format("Y/m/d");
        $end = $this->ends_at->format("Y/m/d");

        return $end > $now;
    }
}
