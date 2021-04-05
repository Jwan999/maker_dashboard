<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;
use Dniccum\PhoneNumber\PhoneNumber;


class Student extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Student::class;

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
        'id',
        'name',
        'email'
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
            Text::make(__('Name'), 'name')->sortable(),

            Text::make(__('Phone Number'), 'phone'),
            BelongsToManyField::make('Training', 'trainings', 'App\Nova\Training')->options(\App\Models\Training::all()),
            Text::make(__('University'), 'university'),

            Text::make(__('Email'), 'email'),
            BelongsToMany::make('Trainings'),

            RadioButton::make(__('Gender'), 'gender')
                ->options([
                    'Female' => 'Female',
                    'Male' => 'Male'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ]),

            Text::make(__('Field of study'), 'field_of_study'),
            Text::make(__('Age'), 'age'),
            Select::make(__('Governorate'), 'governorate')->options([
                'Baghdad' => 'Baghdad',
                'Other' => 'Other'
            ]),
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
        return [new Actions\ImportStudents];
    }
}
