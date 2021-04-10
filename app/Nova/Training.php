<?php

namespace App\Nova;

use App\Nova\Actions\StudentsImporter;
use Gkermer\TextAutoComplete\TextAutoComplete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use NovaAttachMany\AttachMany;
use Benjacho\BelongsToManyField\BelongsToManyField;


use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tests\Feature\SelectTest;
use Davidpiesse\NovaToggle\Toggle;
use OwenMelbz\RadioField\RadioButton;
use Laravel\Nova\Fields\BelongsToMany;
use SimpleSquid\Nova\Fields\AdvancedNumber\AdvancedNumber;


class Training extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Training::class;

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

            Date::make(__('Starting Date'), 'date'),

            TextAutoComplete::make(__('Duration'), 'period')->items([
                '1 Month',
                '1 Day',
                '2 Months',
                '2 Days',
                '3 Months',
                '3 Days',
                '4 Months',
                '4 Days',
                '5 Months',
                '5 Days',
                '6 Months',
                '6 Days',
                '7 Days',
                '8 Days',

            ]),

            Toggle::make(__('In Person'), 'in_person')
                ->trueValue(true)
                ->falseValue(false),
            BelongsTo::make(__("Trainer"), "trainer", Trainer::Class),
//            Select::make(__("Training Type"),"type")->options([
//                'course' => 'Course',
//                'session' => 'Session'
//            ])->displayUsingLabels(),
            RadioButton::make(__('Training Type'), 'type')
                ->options([
                    'Course' => 'Course',
                    'Session' => 'Session'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ]),
            BelongsToMany::make('Students'),


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
        return [
            (new StudentsImporter)->showOnTableRow()
        ];
    }
}

