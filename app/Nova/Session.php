<?php

namespace App\Nova;

use App\Nova\Actions\StudentsImporter;
use App\Nova\Metrics\GenderRatio;
use App\Nova\Metrics\students;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Davidpiesse\NovaToggle\Toggle;
use Gkermer\TextAutoComplete\TextAutoComplete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;
use Saumini\Count\RelationshipCount;

class Session extends Resource
{

    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 135 135" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-28" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M124.566239,-1.42108547e-14 L7.95103641,-1.42108547e-14 C3.55980023,-1.42108547e-14 9.66338121e-13,3.55980035 9.66338121e-13,7.95103653 C9.66338121e-13,12.3422727 3.55980023,15.902073 7.95103641,15.9020731 L7.95103641,92.7620928 C7.95103641,97.153329 11.5108367,100.713129 15.9020729,100.713129 L63.6082921,100.713129 L63.6082921,111.69086 C58.4393054,113.025487 55.0690771,117.995467 55.7417518,123.291424 C56.4144265,128.587381 60.9201311,132.556986 66.2586376,132.556986 C71.5971441,132.556986 76.1028487,128.587381 76.7755234,123.291424 C77.4481981,117.995467 74.0779698,113.025487 68.9089831,111.69086 L68.9089831,100.713129 L116.615202,100.713129 C121.006438,100.713129 124.566239,97.153329 124.566239,92.7620928 L124.566239,15.9020731 C128.957475,15.902073 132.517275,12.3422727 132.517275,7.95103653 C132.517275,3.55980035 128.957475,-1.42108547e-14 124.566239,-1.42108547e-14 Z M71.5593286,121.915893 C71.5593286,124.843384 69.1861284,127.216584 66.2586376,127.216584 C63.3311468,127.216584 60.9579466,124.843384 60.9579466,121.915893 C60.9579466,118.988403 63.3311468,116.615202 66.2586376,116.615202 C69.1861284,116.615202 71.5593286,118.988403 71.5593286,121.915893 Z M119.265548,92.7620928 C119.265548,94.2258382 118.078948,95.4124383 116.615202,95.4124383 L15.9020729,95.4124383 C14.4383275,95.4124383 13.2517274,94.2258382 13.2517274,92.7620928 L13.2517274,15.9020731 L119.265548,15.9020731 L119.265548,92.7620928 Z M124.566239,10.601382 L7.95103641,10.601382 C6.487291,10.601382 5.3006909,9.41478193 5.3006909,7.95103653 C5.3006909,6.48729112 6.487291,5.30069102 7.95103641,5.30069102 L124.566239,5.30069102 C126.029984,5.30069102 127.216584,6.48729112 127.216584,7.95103653 C127.216584,9.41478193 126.029984,10.601382 124.566239,10.601382 Z" id="Shape"></path>
            <path d="M23.8531095,79.5103653 L76.8600196,79.5103653 C78.323765,79.5103653 79.5103651,78.3237651 79.5103651,76.8600197 C79.5103651,75.3962743 78.323765,74.2096742 76.8600196,74.2096742 L23.8531095,74.2096742 C22.3893641,74.2096742 21.2027639,75.3962743 21.2027639,76.8600197 C21.2027639,78.3237651 22.3893641,79.5103653 23.8531095,79.5103653 Z" id="Path"></path>
            <path d="M23.8531095,58.3076012 L108.664166,58.3076012 C110.127911,58.3076012 111.314511,57.1210011 111.314511,55.6572557 C111.314511,54.1935103 110.127911,53.0069102 108.664166,53.0069102 L23.8531095,53.0069102 C22.3893641,53.0069102 21.2027639,54.1935103 21.2027639,55.6572557 C21.2027639,57.1210011 22.3893641,58.3076012 23.8531095,58.3076012 Z" id="Path"></path>
            <path d="M23.8531095,37.1048371 L108.664166,37.1048371 C110.127911,37.1048371 111.314511,35.918237 111.314511,34.4544916 C111.314511,32.9907462 110.127911,31.8041461 108.664166,31.8041461 L23.8531095,31.8041461 C22.3893641,31.8041461 21.2027639,32.9907462 21.2027639,34.4544916 C21.2027639,35.918237 22.3893641,37.1048371 23.8531095,37.1048371 Z" id="Path"></path>
        </g>
    </g>
</svg>
';
    }

    public static $priority = 2;


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type', 'Session');
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
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

//    public static function authorizedToCreate(Request $request)
//    {
//        return false;
//    }


    public function fields(Request $request)
    {
        return [
//            ID::make(__('ID'), 'id'),
            Text::make(__('Name'), 'name')->sortable()->resolveUsing(function ($attribute, $resource, $requestAttribute) {
                return $resource->getOriginal("name");
            })->required(),
            RelationshipCount::make('Number of students', 'students'),
            Date::make(__('Starting Date'), 'date')->sortable()->required(),
            Date::make(__('End Date'), 'end_date')->sortable()->required(),

//            TextAutoComplete::make(__('Duration'), 'period')->items([
//                '1 Month',
//                '1 Day',
//                '2 Months',
//                '2 Days',
//                '3 Months',
//                '3 Days',
//                '4 Months',
//                '4 Days',
//                '5 Months',
//                '5 Days',
//                '6 Months',
//                '6 Days',
//                '7 Days',
//                '8 Days',
//
//            ])->hideFromIndex(),

            Toggle::make(__('In Person'), 'in_person')->required()
                ->trueValue(true)
                ->falseValue(false),

//            BelongsToMany::make(__("Trainer"), "trainers"),
            BelongsToManyField::make(__("Trainers"), "trainers", Trainer::Class)->required(),

            RadioButton::make(__('Training Type'), 'type')
                ->options([
                    'Course' => 'Course',
                    'Session' => 'Session'
                ])->required()
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
//            Select::make('Icon')->options([
//                'cinema_4d' => 'Cinema 4D',
//                '3d' => '3D',
//                'programming' => 'Programming',
//                'cnc' => 'CNC',
//                'crafts' => 'Crafts',
//                'autocad' => 'Autocad',
//                'illustration' => 'Graphic Design',
//                'interface' => 'Finance or Microsoft',
//            ])->hideFromIndex(),
            Textarea::make(__('Description'), 'description')->hideFromIndex()->required(),
            Text::make(__('Training hours'), 'time')->hideFromIndex(),
            Number::make(__('Number of Lectures'), 'lectures')->hideFromIndex(),
//            Text::make(__('Date'), 'date'),
            Text::make(__('Training days'), 'days')->hideFromIndex(),
            Text::make(__('Form link'), 'form_link')->hideFromIndex(),
            Text::make(__('Paid'), 'paid')->required(),


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

        return [
            (new GenderRatio($this::$model))->onlyOnDetail()
        ];
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
        return [
            (new StudentsImporter)->showOnTableRow()

        ];
    }
}
