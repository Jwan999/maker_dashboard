<?php

namespace App\Nova\Filters;

use App\Models\Student;
use Eolica\NovaPillFilter\PillFilter;
use Illuminate\Http\Request;

final class CoursesSessionsFilter extends PillFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {


        $invoices = Student::with(['trainings' => function ($query) {
            $query->where('type', '=', 'Course');
        }])->count();

//todo
        dd($invoices);

        if ($value == 'Course') {
//            $students = ;
        } else {
            $students = Student::with('studentsInSessions');
        }
        return $students;
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Courses' => 'Course',
            'Sessions' => 'Session',
        ];
    }
}
