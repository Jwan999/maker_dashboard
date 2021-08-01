<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Gkermer\TextAutoComplete\TextAutoComplete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;

class Membership extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Membership::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__("Student"), "student", Student::Class)->showCreateRelationButton(),
            Date::make(__('Starts at'), 'starts_at')->sortable(),
            Select::make(__('Duration'), 'duration')->options([
                1 => '1 Month',
                2 => '2 Months',
                3 => '3 Months',
                4 => '4 Months',
                5 => '5 Months',
                6 => '6 Months',
            ])->displayUsingLabels(),


            RadioButton::make(__('Membership type'), 'type')
                ->options([
                    'Golden Membership' => 'Golden Membership',
                    'Silver Membership' => 'Silver Membership'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored']]),// will hide max_skips and skip_sponsored when the value is 1

//            Date::make(__('Ends at'), 'ends_at')->sortable(),
            Boolean::make(__('Is Active'), 'is_active')->sortable()->exceptOnForms(),


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
