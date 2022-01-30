<?php

namespace App\Nova;

use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use App\Others\FixedFilepondController;
use Beyondcode\StartupView\StartupView;
use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;
use Whitecube\NovaFlexibleContent\Flexible;

class Startup extends Resource
{
    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 114 135" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-26" transform="translate(1.000000, 0.999215)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M102.716791,61.1946129 L90.0587404,56.4531448 C89.4781843,33.2931423 76.9682272,12.0783399 56.9824284,0.361232411 C56.1570375,-0.120410804 55.136271,-0.120410804 54.3108802,0.361232411 C34.3332284,12.0835657 21.8318518,33.2974155 21.255771,56.4531448 L8.59772083,61.1972632 C3.43882725,63.1542359 0.0199618683,68.0886156 -1.71240799e-12,73.6061809 L-1.71240799e-12,87.7696273 C-1.71240799e-12,90.3764834 1.27871527,92.8175381 3.42111896,94.3027336 C5.56352265,95.787929 8.29787832,96.1285854 10.7392,95.2144478 L21.3193793,91.257482 C21.8861552,95.152653 25.217646,98.0468575 29.1538006,98.0635692 L29.1538006,103.36426 C29.1538006,107.755496 32.7136009,111.315297 37.1048371,111.315297 L74.2096742,111.315297 C78.6009105,111.315297 82.1607108,107.755496 82.1607108,103.36426 L82.1607108,98.0635692 C86.0968653,98.0468575 89.4283562,95.152653 89.9951321,91.257482 L100.575311,95.2144478 C103.016633,96.1285854 105.750989,95.787929 107.893392,94.3027336 C110.035796,92.8175381 111.314511,90.3764834 111.314511,87.7696273 L111.314511,73.6061809 C111.295645,68.0876454 107.876586,63.1519322 102.716791,61.1946129 L102.716791,61.1946129 Z M55.6572557,5.74143379 C59.6155551,8.20049125 63.2792301,11.104754 66.5766792,14.3974622 C59.5768813,17.2519087 51.73763,17.2519087 44.7378322,14.3974622 C48.0352813,11.104754 51.6989562,8.20049125 55.6572557,5.74143379 L55.6572557,5.74143379 Z M8.8813078,90.2503507 C8.0675777,90.5553772 7.15600972,90.442106 6.44167864,89.947203 C5.72734755,89.4523001 5.30101728,88.6386484 5.30069102,87.7696273 L5.30069102,73.6061809 C5.31113717,70.2941799 7.36364533,67.3319057 10.4609137,66.15871 L21.2027641,62.1328352 L21.2027641,85.6413998 L8.8813078,90.2503507 Z M76.8600197,103.36426 C76.8600197,104.828006 75.6734196,106.014606 74.2096742,106.014606 L37.1048371,106.014606 C35.6410917,106.014606 34.4544916,104.828006 34.4544916,103.36426 L34.4544916,98.0635692 L76.8600197,98.0635692 L76.8600197,103.36426 Z M84.8110563,90.1125327 C84.8110563,91.5762781 83.6244562,92.7628782 82.1607108,92.7628782 L29.1538006,92.7628782 C27.6900552,92.7628782 26.5034551,91.5762781 26.5034551,90.1125327 L26.5034551,58.0221493 C26.5284206,43.5435025 31.649612,29.5357586 40.9690409,18.4551412 C45.5500797,20.6693823 50.5691892,21.8286137 55.6572557,21.8475834 C60.7453222,21.8286137 65.7644316,20.6693823 70.3454705,18.4551412 C79.6648993,29.5357586 84.7860907,43.5435025 84.8110563,58.0221493 L84.8110563,90.1125327 Z M106.01382,87.7696273 C106.013494,88.6386484 105.587164,89.4523001 104.872833,89.947203 C104.158502,90.442106 103.246934,90.5553772 102.433204,90.2503507 L90.1117473,85.6413998 L90.1117473,62.1328352 L100.853598,66.15871 C103.950866,67.3319057 106.003374,70.2941799 106.01382,73.6061809 L106.01382,87.7696273 Z" id="Shape"></path>
            <path d="M55.6572557,34.455277 C43.9472924,34.455277 34.4544916,43.9480778 34.4544916,55.6580411 C34.4544916,67.3680043 43.9472924,76.8608052 55.6572557,76.8608052 C67.3672189,76.8608052 76.8600197,67.3680043 76.8600197,55.6580411 C76.8468743,43.9535272 67.3617696,34.4684224 55.6572557,34.455277 Z M55.6572557,71.5601141 C49.9913222,71.5524577 44.757439,68.5306574 41.9178646,63.62763 C44.7367245,58.6990578 49.9795101,55.6579084 55.6572557,55.6579084 C61.3350013,55.6579084 66.5777869,58.6990578 69.3966468,63.62763 C66.5570724,68.5306574 61.3231891,71.5524577 55.6572557,71.5601141 L55.6572557,71.5601141 Z M71.4533149,57.4337726 C67.4369732,52.9317296 61.6904465,50.35737 55.6572557,50.35737 C49.6240648,50.35737 43.8775381,52.9317296 39.8611964,57.4337726 C39.1555631,51.3534056 42.0025579,45.4077847 47.1818817,42.1453644 C52.3612055,38.8829441 58.9533058,38.8829441 64.1326297,42.1453644 C69.3119535,45.4077847 72.1589483,51.3534056 71.4533149,57.4337726 L71.4533149,57.4337726 Z" id="Shape"></path>
            <path d="M55.6572557,116.615988 C54.1935103,116.615988 53.0069102,117.802588 53.0069102,119.266333 L53.0069102,129.867715 C53.0069102,131.331461 54.1935103,132.518061 55.6572557,132.518061 C57.1210011,132.518061 58.3076012,131.331461 58.3076012,129.867715 L58.3076012,119.266333 C58.3076012,117.802588 57.1210011,116.615988 55.6572557,116.615988 Z" id="Path"></path>
            <path d="M37.1048371,116.615988 C35.6410917,116.615988 34.4544916,117.802588 34.4544916,119.266333 L34.4544916,129.867715 C34.4544916,131.331461 35.6410917,132.518061 37.1048371,132.518061 C38.5685825,132.518061 39.7551826,131.331461 39.7551826,129.867715 L39.7551826,119.266333 C39.7551826,117.802588 38.5685825,116.615988 37.1048371,116.615988 Z" id="Path"></path>
            <path d="M74.2096742,116.615988 C72.7459288,116.615988 71.5593287,117.802588 71.5593287,119.266333 L71.5593287,129.867715 C71.5593287,131.331461 72.7459288,132.518061 74.2096742,132.518061 C75.6734196,132.518061 76.8600197,131.331461 76.8600197,129.867715 L76.8600197,119.266333 C76.8600197,117.802588 75.6734196,116.615988 74.2096742,116.615988 Z" id="Path"></path>
        </g>
    </g>
</svg>
        ';
    }

    public static function availableForNavigation(Request $request)
    {
        if (auth()->user()->email == 'iotkids@makershive.org') {
            return false;
        } else if (auth()->user()->email == 'fallujahmakerspace@makershive.org') {
            return false;
        }else if (auth()->user()->email == 'makerchi@makershive.org') {
            return false;
        }
        else {
            return true;
        }
    }

    public static $priority = 3;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Startup::class;

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

            Filepond::make('Logo')->disk('public')->hideFromDetail()->required(),
            Text::make(__('Startup Name'), 'name')->hideFromDetail()->required(),

            RadioButton::make(__('Startup location'), 'location')
                ->options([
                    'Virtual' => 'Virtual',
                    'In space' => 'In space'
                ])
                ->hideWhenUpdating()
                ->hideFromDetail()
                ->hideFromIndex()
                ->default('In space')
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ])->hideFromDetail()->required(),

            Text::make(__('Idea'), 'idea')->hideFromDetail()->required(),
            Date::make(__('Started Since'), 'started_since')->sortable()->hideFromDetail()->required(),
            Url::make(__('Facebook'), 'facebook')->clickable()->hideFromDetail()->required(),
            Url::make(__('Insta'), 'insta')->clickable()->hideFromDetail()->required(),


            Flexible::make('Founders')
                ->addLayout('Founder', 'wysiwyg', [
                    Text::make('Name'),
                    Text::make('Email'),
                    Text::make('Number'),

                ])->button('Add a founder')->hideFromDetail()->required(),
            StartupView::make('View')->hideWhenCreating()->hideWhenUpdating()->hideFromIndex()

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
}
