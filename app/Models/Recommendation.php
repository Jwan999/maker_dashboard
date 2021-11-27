<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Base
{
    use HasFactory;

    public function recommender(){
        return $this->belongsTo(Trainer::Class);
    }
    public function student(){
        return $this->belongsTo(Student::Class);
    }

    public function training(){
        return $this->belongsTo(Training::Class);
    }
}
