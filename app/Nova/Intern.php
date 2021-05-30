<?php

namespace App\Nova;

use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;

class Intern extends Resource
{
    public static $priority = 5;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Intern::class;

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
            ID::make(__('ID'), 'id')->sortable(),
            ImageUploadPreview::make('Image')->disk('public')->default(function (NovaRequest $request) {
                $model = $request->findModelOrFail();
                return Storage::url($model->image);
            }),

            Text::make(__('Name'), 'name'),
            Number::make(__('Phone'), 'phone'),
            Text::make(__('Email'), 'email'),
            Select::make(__('Governorate'), 'governorate')->options([
                'Baghdad' => 'Baghdad',
                'Other' => 'Other'
            ]),
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
                ]), Text::make(__('Position'), 'position'),
            Text::make(__('Supervisor'), 'supervisor'),

            Text::make(__('Tasks'), 'tasks'),
            Text::make(__('Period'), 'period'),
            Text::make(__('Salary'), 'salary'),


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
