<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Searchable;

class Student extends Base
{
    use Searchable;

    use HasFactory;

//    protected $appends = ["is_adult"];
    protected $casts = [
//        'age' => 'date',
//        'date_of_birth' => 'date',

//        'date_of_birth' => 'datetime'
    ];

//public function getIsAdultAttribute(){
//    return $this->age >= 18;
//}
    public function trainings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }

// todo
    public function studentsInCourses()
    {
        return $this->belongsToMany(Training::class)->where('type', 'Course')->count();

    }

    public function studentsInSessions()
    {
        return $this->belongsToMany(Training::class)->where('type', 'Session')->count();

    }

    public function run()
    {
        User::factory()
            ->count(50)
            ->create();
    }
}
