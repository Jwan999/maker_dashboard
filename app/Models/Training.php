<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    public function getNameAttribute($name)
    {
        $fullname = $name;
        if ($this->date)
            $fullname .= " - " . $this->date->format("M, Y");
        return $fullname;
    }

//    public function getSomethingNotInTheDbAttribute()
//    {
//        return $this->name . $this->date;
//    }

    protected $casts = [
        'date' => 'date'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);

    }

}
