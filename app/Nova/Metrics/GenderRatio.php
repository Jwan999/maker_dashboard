<?php

namespace App\Nova\Metrics;

use App\Models\Student;
use App\Models\Training;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class GenderRatio extends Partition
{


    private $query;

    public function __construct($model)
    {

        parent::__construct(null);


        $this->query = Student::whereHas("trainings", function ($query) {
            return $query->where("id", "=", request()->route("resourceId"));
        });

        Log::info($this->query->toSql());
    }

    /**
     * Calculate the value of the metric.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, $this->query, 'gender');
    }


    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'gender-ratio';
    }
}
