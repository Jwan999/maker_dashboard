<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Base
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'date',
//        'ends_at' => 'date',

    ];

    public function student()
    {
        return $this->belongsTo(Student::class);

    }

    public function getIsActiveAttribute()
    {
        /** @var Carbon $expiresAt */
        $expiresAt = $this->starts_at->addMonths($this->duration);
        return Carbon::now()->isBefore($expiresAt);
    }
}
