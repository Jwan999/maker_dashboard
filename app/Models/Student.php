<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'datetime'
    ];

    public function trainings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }

    public function run()
    {
        User::factory()
            ->count(50)
            ->create();
    }
}
