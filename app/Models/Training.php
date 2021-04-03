<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class);

    }

}
