<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;
class Training extends Base
{
//    use Searchable;
    use HasFactory;

    protected $with = ["students"];

    public function getNameAttribute($name)
    {
        $fullname = $name;
//        if ($this->date)
//            $fullname .= " - " . $this->date->format("M, Y");
        return $fullname;
    }

//    public function getSomethingNotInTheDbAttribute()
//    {
//        return $this->name . $this->date;
//    }

    protected $casts = [
        'date' => 'date',
        'end_date' => 'date'
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

