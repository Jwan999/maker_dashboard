<?php

namespace App\Nova;

use App\Nova\Actions\StudentsImporter;
use App\Nova\Metrics\GenderRatio;
use Gkermer\TextAutoComplete\TextAutoComplete;
use Illuminate\Http\Request;
use Comodolab\Nova\Fields\Help\Help;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use NovaAttachMany\AttachMany;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tests\Feature\SelectTest;
use Davidpiesse\NovaToggle\Toggle;
use OwenMelbz\RadioField\RadioButton;
use Laravel\Nova\Fields\BelongsToMany;
use Saumini\Count\RelationshipCount;
use SimpleSquid\Nova\Fields\AdvancedNumber\AdvancedNumber;


class Training extends Resource
{
    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 135 135" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-27" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M124.566239,4.26325641e-14 L15.9020731,4.26325641e-14 C11.5108368,4.26325641e-14 7.95103653,3.55980031 7.95103653,7.95103653 L7.95103653,66.2586377 C7.96733426,66.4650842 8.00826352,66.6688408 8.07295242,66.8655668 C3.02480525,70.3211156 0.00465141182,76.0431471 -6.39488462e-13,82.1607108 L-6.39488462e-13,106.01382 C-6.39488462e-13,109.800808 2.02206683,113.299655 5.30195502,115.192697 C8.5818432,117.085739 12.6224457,117.085461 15.9020731,115.191967 L15.9020731,129.86693 C15.9020731,131.330675 17.0886732,132.517275 18.5524186,132.517275 L60.9579467,132.517275 C62.4216921,132.517275 63.6082922,131.330675 63.6082922,129.86693 L63.6082922,100.713129 L124.566239,100.713129 C128.957475,100.713129 132.517275,97.153329 132.517275,92.7620928 L132.517275,7.95103653 C132.517275,3.55980031 128.957475,4.26325641e-14 124.566239,4.26325641e-14 L124.566239,4.26325641e-14 Z M60.9579467,79.5103653 C59.4942013,79.5103653 58.3076012,80.6969654 58.3076012,82.1607108 L58.3076012,127.216584 L21.2027641,127.216584 L21.2027641,82.1607108 C21.2027641,80.6969654 20.016164,79.5103653 18.5524186,79.5103653 C17.0886732,79.5103653 15.9020731,80.6969654 15.9020731,82.1607108 L15.9020731,106.01382 C15.9020731,108.941311 13.5288728,111.314511 10.601382,111.314511 C7.67389122,111.314511 5.30069102,108.941311 5.30069102,106.01382 L5.30069102,82.1607108 C5.30945337,74.8456163 11.2373241,68.9177456 18.5524186,68.9089832 L90.1117473,68.9089832 C93.0392381,68.9089832 95.4124383,71.2821834 95.4124383,74.2096742 C95.4124383,77.137165 93.0392381,79.5103653 90.1117473,79.5103653 L60.9579467,79.5103653 Z M29.1538006,50.3565647 C29.1538006,43.0378376 35.0868011,37.1048371 42.4055281,37.1048371 C49.7242552,37.1048371 55.6572557,43.0378376 55.6572557,50.3565647 C55.6572557,57.6752917 49.7242552,63.6082922 42.4055281,63.6082922 C35.0904337,63.5995299 29.1625629,57.6716591 29.1538006,50.3565647 Z M127.216584,92.7620928 C127.216584,94.2258382 126.029984,95.4124383 124.566239,95.4124383 L63.6082922,95.4124383 L63.6082922,84.8110563 L90.1117473,84.8110563 C95.9667289,84.8110563 100.713129,80.0646559 100.713129,74.2096742 C100.70171,72.4216581 100.230776,70.666607 99.345551,69.1130598 L105.568562,59.7785429 C106.094079,58.9907411 106.159389,57.9824222 105.739891,57.1334103 C105.320393,56.2843984 104.479819,55.7236786 103.534804,55.6624685 C102.589789,55.6012585 101.683904,56.0488576 101.158387,56.8366594 L95.5926618,65.1825974 C93.9463961,64.1611488 92.0491388,63.6161919 90.1117473,63.6082922 L55.3657177,63.6082922 C60.7639596,58.3380685 62.4332194,50.3237545 59.5880142,43.3365461 C56.7428091,36.3493376 49.9498157,31.78087 42.4055281,31.78087 C34.8612406,31.78087 28.0682472,36.3493376 25.223042,43.3365461 C22.3778369,50.3237545 24.0470966,58.3380685 29.4453386,63.6082922 L18.5524186,63.6082922 C16.7562225,63.6136879 14.9704564,63.8815528 13.2517275,64.4033959 L13.2517275,7.95103653 C13.2517275,6.48729112 14.4383276,5.30069102 15.9020731,5.30069102 L124.566239,5.30069102 C126.029984,5.30069102 127.216584,6.48729112 127.216584,7.95103653 L127.216584,92.7620928 Z" id="Shape"></path>
            <path d="M65.2833106,31.6186219 C65.9376384,31.8790702 66.6687202,31.8683851 67.3151571,31.5889255 C67.9615939,31.3094659 68.4702245,30.7842138 68.7287597,30.1291277 C70.0300794,26.8426993 73.8280245,19.8272347 77.2522709,19.1169422 C77.8698014,18.9923759 78.8424782,18.9870752 80.2922172,20.4262128 C81.9778369,22.1118326 80.6924193,27.0520766 79.6587846,31.0275949 C78.296507,36.275279 76.8838729,41.7031866 80.5572517,44.5099025 C84.0901623,47.2079542 88.1054357,43.6511905 91.651598,40.5105311 C94.1985801,38.2577374 97.6943858,35.1727352 98.8446357,36.3256355 C100.512049,38.2965815 101.831373,40.5372799 102.745944,42.9514993 C104.776109,47.4358839 107.304539,53.0228122 113.970158,53.0228122 C115.433903,53.0228122 116.620503,51.8362121 116.620503,50.3724667 C116.620503,48.9087213 115.433903,47.7221212 113.970158,47.7221212 C111.028274,47.7221212 109.764059,45.6018448 107.572223,40.770265 C106.415193,37.7694202 104.728395,35.00088 102.592224,32.5965994 C97.9064134,27.9107885 92.0279471,33.1266685 88.1345895,36.5721177 C86.759898,37.9076365 85.2396904,39.084686 83.6024987,40.0811751 C83.5442557,37.4693531 83.9461719,34.8676634 84.7898535,32.3951731 C86.2342918,26.8294476 87.869555,20.5401777 84.0398057,16.7104284 C82.0934875,14.4632104 79.1017409,13.4161999 76.1788809,13.9593698 C69.0494515,15.4356122 64.3159345,26.9063076 63.7991171,28.2102776 C63.2805515,29.5610587 63.9411626,31.0781049 65.2833106,31.6186219 Z" id="Path"></path>
        </g>
    </g>
</svg>
        ';
    }

    public static $priority = 1;


    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type', 'Course');
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
            Text::make(__('Name'), 'name')->sortable()->resolveUsing(function ($attribute, $resource, $requestAttribute) {
                return $resource->getOriginal("name");
            }),
            RelationshipCount::make('Number of students', 'students'),
            Date::make(__('Starting Date'), 'date')->sortable(),
            Date::make(__('End Date'), 'end_date')->sortable(),

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

            ])->hideFromIndex(),

            Toggle::make(__('In Person'), 'in_person')
                ->trueValue(true)
                ->falseValue(false),

            BelongsToMany::make(__("Trainer"), "trainers"),
            BelongsToManyField::make(__("Trainer"), "trainers", Trainer::Class),

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
            Select::make('Icon')->options([
                'cinema_4d' => 'Cinema 4D',
                '3d' => '3D',
                'programming' => 'Programming',
                'cnc' => 'CNC',
                'crafts' => 'Crafts',
                'autocad' => 'Autocad',
                'illustration' => 'Graphic Design',
                'interface' => 'Finance or Microsoft',
            ])->hideFromIndex(),
            Textarea::make(__('Description'), 'description')->hideFromIndex(),
            Text::make(__('Time'), 'time')->hideFromIndex(),
            Number::make(__('Number of Lectures'), 'lectures')->hideFromIndex(),
//            Text::make(__('Date'), 'date'),
            Text::make(__('Days'), 'days')->hideFromIndex(),
            Text::make(__('Form link'), 'form_link')->hideFromIndex(),
            Text::make(__('Paid'), 'paid'),


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

