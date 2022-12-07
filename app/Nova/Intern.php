<?php

namespace App\Nova;

use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use OwenMelbz\RadioField\RadioButton;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Intern extends Resource
{

    public static function icon()
    {
        return '
<svg class="sidebar-icon" viewBox="0 0 103 135" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Shape-4" transform="translate(0.998385, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M65.4121421,76.5154748 C105.856415,59.8978085 93.3732873,4.26325641e-14 50.3581797,4.26325641e-14 C7.34307205,4.26325641e-14 -4.95453111,59.7652912 35.118693,76.4624679 C14.0900274,83.0043246 -0.174629823,102.544214 0.00161499115,124.566239 C0.00161499115,126.674985 0.839311077,128.697362 2.33041967,130.188471 C3.82152827,131.679579 5.84390552,132.517275 7.95265152,132.517275 L92.7637078,132.517275 C97.154944,132.517275 100.714744,128.957475 100.714744,124.566239 C100.713444,102.55523 86.4165788,83.095608 65.4121421,76.5154748 Z M48.7944758,127.216584 L40.2868667,118.682472 L50.3581797,96.5255834 L60.4294926,118.682472 L51.9218835,127.216584 L48.7944758,127.216584 Z M50.3581797,85.8711945 L45.5080474,79.8019033 C48.7300477,79.4175627 51.9863116,79.4175627 55.2083119,79.8019033 L50.3581797,85.8711945 Z M82.7454018,28.1201658 L76.5435933,32.3342152 C75.593353,28.8997497 72.4740695,26.5169636 68.9105982,26.5034551 L60.9595617,26.5034551 C56.5683255,26.5034551 53.0085252,30.0632554 53.0085252,34.4544916 L47.7078341,34.4544916 C47.7078341,30.0632554 44.1480338,26.5034551 39.7567976,26.5034551 C36.2583415,27.0865311 26.5050701,24.0651372 24.172766,32.3342152 L17.9709575,28.1201658 C28.9168845,-2.22629023 71.7994748,-2.25279368 82.7454018,28.1201658 Z M58.3092162,34.4544916 C58.3092162,32.9907462 59.4958163,31.8041461 60.9595617,31.8041461 L68.9105982,31.8041461 C70.3743436,31.8041461 71.5609437,32.9907462 71.5609437,34.4544916 L71.5609437,39.7551826 C71.5609437,41.218928 70.3743436,42.4055281 68.9105982,42.4055281 C64.4845212,41.9019625 58.3092162,43.9162251 58.3092162,39.7551826 L58.3092162,34.4544916 Z M42.4071431,39.7551826 C42.4071431,43.9162251 36.2318381,41.9019625 31.8057611,42.4055281 C27.8567463,42.4055281 29.526464,36.866306 29.1554156,34.4544916 C29.1554156,32.9907462 30.3420157,31.8041461 31.8057611,31.8041461 C36.2318381,32.3077117 42.4071431,30.2934492 42.4071431,34.4544916 L42.4071431,39.7551826 Z M16.4867641,33.5003672 L23.8547246,38.5095202 L23.8547246,39.7551826 C23.8547246,44.1464188 27.4145249,47.7062192 31.8057611,47.7062192 L39.7567976,47.7062192 C44.1480338,47.7062192 47.7078341,44.1464188 47.7078341,39.7551826 L53.0085252,39.7551826 C53.0085252,44.1464188 56.5683255,47.7062192 60.9595617,47.7062192 L68.9105982,47.7062192 C73.3018344,47.7062192 76.8616347,44.1464188 76.8616347,39.7551826 L76.8616347,38.5095202 L84.2295952,33.5003672 C86.7639457,47.1005493 80.9179635,60.8977251 69.384216,68.5371329 C57.8504685,76.1765408 42.8658908,76.1765408 31.3321433,68.5371329 C19.7983958,60.8977251 13.9524136,47.1005493 16.4867641,33.5003672 L16.4867641,33.5003672 Z M5.30230601,124.566239 L5.30230601,124.566239 C5.08116845,103.780153 19.2720924,85.6069693 39.4917631,80.7825311 L47.2837789,90.5092991 L34.6946377,118.178906 C34.2364067,119.182267 34.4475271,120.364541 35.2247068,121.147293 L41.3205015,127.216584 L7.95265152,127.216584 C6.48890611,127.216584 5.30230601,126.029984 5.30230601,124.566239 Z M92.7637078,127.216584 L59.3958578,127.216584 L65.4916525,121.147293 C66.2688322,120.364541 66.4799526,119.182267 66.0217216,118.178906 L53.4325804,90.5092991 L61.1715893,80.835538 C81.2816139,85.8072524 95.410228,103.850761 95.4140533,124.566239 C95.4140533,125.269154 95.1348213,125.94328 94.6377851,126.440316 C94.1407489,126.937352 93.4666231,127.216584 92.7637078,127.216584 Z M37.7160316,62.6541678 C36.7792346,61.5270839 36.9334926,59.8539778 38.0605765,58.9171807 C39.1876605,57.9803837 40.8607666,58.1346417 41.7975637,59.2617256 C43.7936331,61.9942476 46.9742515,63.6096961 50.3581797,63.6096961 C53.7421078,63.6096961 56.9227262,61.9942476 58.9187956,59.2617256 C59.8555927,58.1346416 61.5286988,57.9803836 62.6557828,58.9171807 C63.7828668,59.8539777 63.9371248,61.5270839 63.0003277,62.6541678 C59.9921892,66.5965234 55.3171175,68.9098934 50.3581797,68.9098934 C45.3992418,68.9098934 40.7241701,66.5965234 37.7160316,62.6541678 Z" id="Shape"></path>
        </g>
    </g>
</svg>
';
    }

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
        'name', 'Tasks'
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
            Filepond::make('Image')->disk('public'),

            Text::make(__('Name'), 'name')->required(),
            Number::make(__('Phone'), 'phone')->required(),
            Text::make(__('Email'), 'email')->required(),
            Select::make(__('Governorate'), 'governorate')->options([
                'Baghdad' => 'Baghdad',
                'Al Anbar' => 'Al Anbar',
                'Basra' => 'Basra',
                'Nasiriyah' => 'Nasiriyah',
                'Al-Qādisiyyah' => 'Al-Qādisiyyah',
                'Diyala' => 'Diyala',
                'Duhok' => 'Duhok',
                'Erbil' => 'Erbil',
                'Babylon' => 'Babylon',
                'Halabja' => 'Halabja',
                'Karbala' => 'Karbala',
                'Kirkuk' => 'Kirkuk',
                'Amarah' => 'Amarah',
                'Samawah' => 'Samawah',
                'Najaf' => 'Najaf',
                'Mosul' => 'Mosul',
                'Saladin' => 'Saladin',
                'Sulaymaniyah' => 'Sulaymaniyah',
                'Wasit' => 'Wasit',
            ])->required(),
            RadioButton::make(__('Gender'), 'gender')
                ->options([
                    'Female' => 'Female',
                    'Male' => 'Male'
                ])->required()
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ]),

            Text::make(__('Age'), 'age')->required(),
            Text::make(__('Education level'), 'education')->required(),

            Text::make(__('Position'), 'position')->required(),
            Text::make(__('Supervisor'), 'supervisor')->required(),
            Date::make(__('Started at'), 'starting_date')->sortable(),

            Text::make(__('Tasks'), 'tasks')->required(),
            Text::make(__('Period'), 'period')->required(),
            Text::make(__('Salary'), 'salary')->required(),
            Text::make(__('Paid by'), 'paid_by')->required(),


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
        return [
            (new DownloadExcel)->askForFilename()->withHeadings()->allFields()->showOnIndex(),
        ];
    }
}
