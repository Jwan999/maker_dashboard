<?php

namespace App\Nova;

use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
//            ID::make(__('ID'), 'id')->sortable(),
            Filepond::make('Icon')->disk('public')->required(),
            Text::make(__('Name'), 'name')->required(),
            Text::make(__('Sponsored by'), 'sponsored_by')->required(),
            Textarea::make(__('Overview'), 'overview')->required(),
            Date::make(__('Starting Date'), 'starting_date')->sortable()->required(),
            Select::make(__('Duration'), 'duration')->options([
                1 => '1 Month',
                2 => '2 Months',
                3 => '3 Months',
                4 => '4 Months',
                5 => '5 Months',
                6 => '6 Months',
                8 => '8 Months',
                9 => '9 Months',
                10 => '10 Months',
                11 => '11 Months',
                12 => '1 Year',
                24 => '2 Years',
                36 => '3 Years',
            ])->displayUsingLabels()->required(),
        ];

    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
