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
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Membership extends Resource
{


    public static function icon()
    {
        return '


<svg class="sidebar-icon" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="3" stroke="var(--sidebar-icon)" fill="none" fill-rule="evenodd">
        <g stroke-width="6" stroke="var(--sidebar-icon)" id="customer-support" fill="var(--sidebar-icon)" fill-rule="nonzero">
            <path d="M1.36952737,46.847636 L35.429072,106.448336 C36.5779337,108.462347 38.5008757,109.91944 40.7495617,110.483363 L72.5253936,118.427321 L181.509632,227.411559 L193.551664,215.37303 L82.861646,104.686515 C81.7723288,103.593695 80.4063047,102.819615 78.9106828,102.444834 L48.3782837,94.7845882 L19.3800348,44.0105077 L44.2416815,19.1488619 L95.0367774,48.1751309 L102.700525,78.7075309 C103.071804,80.2066552 103.849387,81.5761817 104.938704,82.6654989 L215.628721,193.355517 L227.667251,181.313485 L118.683012,72.3292465 L110.739054,40.5709284 C110.175132,38.3187391 108.718039,36.3922947 106.704028,35.2399297 L47.0998251,1.18388747 C43.7758314,-0.7075302 39.5936953,-0.147109884 36.8826615,2.55341484 L2.82662019,36.6129595 C0.0875656294,39.3064803 -0.507880687,43.4956213 1.36952737,46.847636 Z" id="Path"></path>
            <polygon id="Path" points="355.362522 167.807355 168.045534 355.127846 156.003503 343.085815 343.323993 155.768827"></polygon>
            <path d="M135.260945,361.754816 C133.71979,359.190893 130.952715,357.625219 127.961471,357.625219 L76.8756567,357.625219 C73.8879162,357.625219 71.117338,359.190893 69.5796845,361.754816 L44.0350263,404.325745 C42.4133098,407.022767 42.4133098,410.395797 44.0350263,413.096322 L69.5796845,455.66725 C71.117338,458.227671 73.8879162,459.796848 76.8756567,459.796848 L127.961471,459.796848 C130.952715,459.796848 133.71979,458.227671 135.260945,455.66725 L160.802101,413.096322 C162.423818,410.395797 162.423818,407.022767 160.802101,404.325745 L135.260945,361.754816 Z M123.145359,442.767075 L81.6952715,442.767075 L61.2609453,408.711033 L81.6952715,374.651489 L123.145359,374.651489 L143.579685,408.711033 L123.145359,442.767075 Z" id="Shape"></path>
            <path d="M408.938704,204.364273 C465.17338,204.553415 510.917688,159.117338 511.10683,102.882662 C511.134851,94.3222415 510.084063,85.7968479 507.978984,77.4991248 C506.844133,72.9352016 502.224168,70.1576187 497.660245,71.2924689 C496.161121,71.6672502 494.795096,72.4413305 493.702277,73.5306478 L440.700525,126.497373 L398.647986,112.483362 L384.623467,70.4413312 L437.625219,17.4290718 C440.949212,14.1015757 440.945709,8.7110335 437.618214,5.38703983 C436.521892,4.29071781 435.141856,3.51313508 433.632224,3.14185617 C379.096322,-10.6690022 323.695272,22.3432577 309.884413,76.8756567 C307.78634,85.1488621 306.739055,93.6532395 306.767076,102.189142 C306.788091,108.89317 307.478108,115.576182 308.837128,122.140105 L122.367776,308.605955 C115.803853,307.250438 109.12084,306.560421 102.420315,306.535902 C45.9894917,306.535902 0.245184336,352.28021 0.245184336,408.711033 C0.245184336,465.138354 45.9894917,510.882662 102.420315,510.882662 C158.847636,510.882662 204.591944,465.138354 204.591944,408.711033 C204.570928,402.007005 203.877408,395.323993 202.521891,388.76007 L247.162872,344.11909 L266.686515,363.642732 C270.01401,366.966725 275.401051,366.966725 278.728546,363.642732 L282.984238,359.383538 C286.718038,355.674255 292.753065,355.674255 296.486865,359.383538 C300.217163,363.103327 300.224168,369.141857 296.504378,372.872154 C296.500876,372.875657 296.49387,372.882662 296.486865,372.889667 L292.231173,377.145359 C288.907181,380.469352 288.907181,385.859895 292.231173,389.183888 L393.800351,490.753065 C420.514886,517.712785 464.024519,517.908932 490.984238,491.194396 C517.940455,464.47986 518.136602,420.966725 491.422066,394.010507 C491.278459,393.863398 491.131348,393.716288 490.984238,393.569177 L389.415061,292.003503 C386.091068,288.679509 380.700525,288.679509 377.376532,292.003503 L373.120841,296.259195 C369.383538,299.971979 363.352014,299.971979 359.614711,296.259195 C355.887916,292.539405 355.877408,286.500876 359.597198,282.774081 C359.604203,282.767075 359.611208,282.763572 359.614711,282.756568 L363.873906,278.497373 C367.197899,275.17338 367.197899,269.782837 363.873906,266.458844 L344.350263,246.935201 L388.991243,202.294221 C395.555167,203.649738 402.238179,204.343257 408.938704,204.364273 Z M442.392294,493.856425 C436.206655,493.845884 430.073555,492.728546 424.283713,490.553415 L490.781086,424.05254 C500.816112,450.74606 487.313485,480.518389 460.619965,490.553415 C454.795096,492.742557 448.619965,493.863398 442.392294,493.856425 Z M345.93345,272.563923 C336.504378,283.810858 337.982487,300.574431 349.229422,310 C359.113836,318.283713 373.52014,318.276708 383.394046,309.975481 L478.94571,405.611208 C479.982487,406.651489 480.952715,407.747811 481.891419,408.861646 L409.09282,481.660245 C407.975481,480.725044 406.879159,479.754816 405.838879,478.714536 L310.213661,383.082311 C319.642732,371.835377 318.164623,355.071804 306.917688,345.646234 C297.033275,337.359019 282.623467,337.369527 272.749563,345.66725 L259.127846,332.045534 L332.308231,258.97373 L345.93345,272.563923 Z M380.315236,186.928196 L187.162872,380.042032 C185.043783,382.157618 184.192645,385.229422 184.914185,388.1331 C196.595447,434.007005 168.875657,480.6655 122.998249,492.343257 C77.1243435,504.024519 30.4658489,476.304728 18.7845887,430.427321 C7.1068299,384.553416 34.8266202,337.894921 80.7040278,326.213661 C94.5814363,322.683013 109.12084,322.683013 122.998249,326.213661 C125.901926,326.924693 128.966725,326.073556 131.089317,323.968476 L324.196148,130.851139 C326.311733,128.735551 327.162872,125.663748 326.434326,122.763572 C314.833625,77.425569 342.182136,31.2679512 387.52014,19.6637483 C396.087566,17.4746057 404.949212,16.6339753 413.775832,17.1838875 L368.861647,62.1155871 C366.581436,64.3922942 365.782837,67.7653242 366.802101,70.8231173 L383.828372,121.912435 C384.679509,124.451839 386.676007,126.448336 389.218914,127.29247 L440.308231,144.322242 C443.362522,145.341506 446.735552,144.54641 449.015761,142.269702 L493.929947,97.3555169 C494.031524,98.9807358 494.085184,100.588442 494.085184,102.189142 C494.322241,148.97373 456.591944,187.09282 409.807356,187.334501 C402.574431,187.369528 395.366024,186.47986 388.36077,184.686515 C385.457093,183.961471 382.385289,184.809107 380.269703,186.924694 L380.315236,186.924694 L380.315236,186.928196 Z" id="Shape"></path>
            <polygon id="Path" points="440.511384 428.231173 428.469352 440.273204 343.327496 355.131349 355.366024 343.089317"></polygon>
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
//            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__("Member"), "student", Student::Class)->showCreateRelationButton()->required(),
            Date::make(__('Starts at'), 'starts_at')->sortable()->required(),
            Select::make(__('Duration'), 'duration')->options([
                1 => '1 Day',
                7 => '1 Week',
                14 => '2 Weeks',
                30 => '1 Month',
                90 => '2 Months',
                120 => '3 Months',
                150 => '4 Months',
            ])->displayUsingLabels()->required(),


//            RadioButton::make(__('Membership type'), 'type')
//                ->options([
//                    'Golden Membership' => 'Golden Membership',
//                    'Silver Membership' => 'Silver Membership',
//                    'Daily Membership' => 'Daily Membership',
//                ])->required()
//                ->stack() // optional (required to show hints)
//                ->marginBetween() // optional
//                ->skipTransformation() // optional
//                ->toggle([  // optional
//                    1 => ['max_skips', 'skip_sponsored']]),// will hide max_skips and skip_sponsored when the value is 1

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
