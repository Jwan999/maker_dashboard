<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Attendee extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Attendee::class;

//    public static $displayInNavigation = false;

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
            Text::make(__('Name'), 'name'),
            Text::make(__('Number'), 'number'),
            Text::make(__('Email'), 'email'),
            Text::make(__('Gender'), 'gender'),
            Text::make(__('Age'), 'age'),
            BelongsToMany::make('events'),

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
        return [
            new DateRangeFilter('Created at', 'created_at', [
                Config::ALLOW_INPUT => false,
                Config::DATE_FORMAT => 'Y-m-d',
//                Config::DEFAULT_DATE => ['2019-06-01', '2019-06-30'],
                Config::DISABLED => false,
                Config::ENABLE_TIME => false,
                Config::ENABLE_SECONDS => false,
                Config::FIRST_DAY_OF_WEEK => 0,
                Config::LOCALE => 'default',
//                Config::MAX_DATE => '2019-12-31',
//                Config::MIN_DATE => '2019-01-01',
                Config::PLACEHOLDER => __('Choose date range'),
                Config::SHORTHAND_CURRENT_MONTH => false,
                Config::SHOW_MONTHS => 1,
                Config::TIME24HR => false,
                Config::WEEK_NUMBERS => false,
            ]),
        ];
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

    public static $displayInNavigation = false;

}
