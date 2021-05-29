<?php

namespace App\Nova;

use App\Nova\Actions\StudentsImporter;
use Gkermer\TextAutoComplete\TextAutoComplete;
use Illuminate\Http\Request;
use Comodolab\Nova\Fields\Help\Help;
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
    public static $priority = 1;


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type', 'course');
    }

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
//        'id',
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
//            ID::make(__('ID'), 'id'),
            Text::make(__('Name'), 'name')->sortable(),

            Date::make(__('Starting Date'), 'date')->sortable(),

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
            Help::make('If the trainer is not in the list please add it through <a href="/resources/trainers/new">here</a>')->displayAsHtml()->icon('<?xml version="1.0" encoding="UTF-8"?>
<svg width="88px" height="88px" viewBox="0 0 88 88" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="info-circle-(1)" fill="#4A5568" fill-rule="nonzero">
            <path d="M44,0 C19.699471,0 7.81597009e-15,19.699471 7.81597009e-15,44 C7.81597009e-15,68.300529 19.699471,88 44,88 C68.300529,88 88,68.300529 88,44 C87.9729868,19.710669 68.289331,0.0270132007 44,0 Z M44,79.2 C24.5595768,79.2 8.8,63.4404232 8.8,44 C8.8,24.5595768 24.5595768,8.8 44,8.8 C63.4404232,8.8 79.2,24.5595768 79.2,44 C79.1777652,63.4312058 63.4312058,79.1777652 44,79.2 L44,79.2 Z M44,41.8 C41.5699471,41.8 39.6,43.7699471 39.6,46.2 L39.6,59.4 C39.6,61.8300529 41.5699471,63.8 44,63.8 C46.4300529,63.8 48.4,61.8300529 48.4,59.4 L48.4,46.2 C48.4,43.7699471 46.4300529,41.8 44,41.8 Z M44,24.2 C40.9624339,24.2 38.5,26.6624339 38.5,29.7 C38.5,32.7375661 40.9624339,35.2 44,35.2 C47.0375661,35.2 49.5,32.7375661 49.5,29.7 C49.5,26.6624339 47.0375661,24.2 44,24.2 L44,24.2 Z" id="Shape"></path>
        </g>
    </g>
</svg>'),

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
                ->hideWhenUpdating()
                ->hideFromDetail()
                ->hideFromIndex()
                ->default('Course')
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

