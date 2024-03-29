<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Contest extends Resource
{

//    public static function label()
//    {
//        return ;
//    }

    public static function icon()
    {
        return '
<svg class="sidebar-icon" viewBox="0 0 130 132" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-24" transform="translate(1.003151, 0.999073)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M125.65503,100.714056 L110.479152,85.540828 C123.216034,65.5672361 121.90643,39.7185331 107.216056,21.1345219 C92.5256826,2.55051064 67.6776474,-4.69142692 45.3030789,3.09004022 C22.9285104,10.8715074 7.93644882,31.9691044 7.94788529,55.6581824 C7.9479061,66.253117 10.9929947,76.6248175 16.7205289,85.5381777 L1.54995123,100.714056 C0.187333709,102.078649 -0.326683942,104.075609 0.207751922,105.928503 C0.742187786,107.781398 2.24074971,109.197863 4.12078637,109.627168 L17.2399966,112.622058 L20.2348871,125.741269 C20.6636165,127.622403 22.0806043,129.122026 23.9344469,129.656576 C25.7882894,130.191126 27.7861745,129.676173 29.1506494,128.312104 L48.3285495,109.134204 C58.3026214,112.042443 68.8997095,112.042443 78.8737814,109.134204 L98.0596326,128.312104 C99.4242255,129.674721 101.421185,130.188739 103.27408,129.654303 C105.126974,129.119867 106.54344,127.621305 106.972745,125.741269 L109.967635,112.616758 L123.086845,109.624518 C124.965341,109.193916 126.462118,107.777678 126.995855,105.925844 C127.529593,104.074011 127.016185,102.078395 125.65503,100.714056 L125.65503,100.714056 Z M25.4030608,124.567166 L22.4108207,111.440004 C21.9443192,109.463788 20.397463,107.923095 18.4194004,107.464486 L5.29753978,104.458994 L19.8320345,89.9218492 C25.8325919,97.5857385 33.7305986,103.54967 42.7442715,107.223305 L25.4030608,124.567166 Z M13.2485763,55.6581824 C13.2485763,27.8470197 35.7939782,5.30161776 63.605141,5.30161776 C91.4163037,5.30161776 113.961706,27.8470197 113.961706,55.6581824 C113.961706,83.4693451 91.4163037,106.014747 63.605141,106.014747 C35.8066937,105.984073 13.2792501,83.4566297 13.2485763,55.6581824 Z M108.77763,107.451234 C106.805077,107.914016 105.264894,109.4542 104.802112,111.426753 L101.80192,124.567166 L84.4580594,107.225955 C93.4722827,103.553289 101.37052,97.5891834 107.370296,89.9244995 L121.912742,104.458994 L108.77763,107.451234 Z" id="Shape"></path>
            <path d="M86.7055524,41.2376525 L76.7137498,39.7852632 L72.2452673,30.7290326 C70.6200931,27.4403194 67.26952,25.3587072 63.6011654,25.3587072 C59.9328109,25.3587072 56.5822377,27.4403194 54.9570636,30.7290326 L50.488581,39.7852632 L40.4941281,41.2376525 C36.866366,41.7666508 33.8529952,44.3082914 32.719846,47.7949044 C31.5866967,51.2815174 32.53007,55.1090998 35.1536819,57.6697947 L42.3864748,64.7197137 L40.6796523,74.6744114 C40.0636385,78.2888749 41.5509957,81.9399341 44.5173861,84.0950088 C47.4837764,86.2500836 51.4157757,86.5361724 54.6628752,84.8331858 L63.605141,80.1394239 L72.542106,84.8384865 C75.7892666,86.5452218 79.723723,86.2609068 82.6917613,84.1050435 C85.6597995,81.9491802 87.1468877,78.2955039 86.5279793,74.6797121 L84.807905,64.7250144 L92.0433483,57.6750954 C94.6679852,55.1143156 95.6123579,51.2861324 94.4798029,47.7984926 C93.3472478,44.3108529 90.3339389,41.7678633 86.7055524,41.2376525 L86.7055524,41.2376525 Z M88.3487666,53.8798006 L80.1326956,61.9023964 C79.5087316,62.5115132 79.2243055,63.3885763 79.3720464,64.2479522 L81.3147496,75.5755289 C81.6002989,77.2086825 80.9295647,78.8617014 79.5867658,79.8341314 C78.2439669,80.8065613 76.4641995,80.9281499 75.0016266,80.1473749 L64.8296006,74.801628 C64.0572663,74.3954109 63.1344632,74.3954109 62.3621289,74.801628 L52.2086553,80.1473749 C50.7477043,80.9181984 48.975592,80.7913887 47.6392828,79.8203974 C46.3029736,78.849406 45.6349282,77.2031442 45.916735,75.5755289 L47.8594383,64.2479522 C48.006506,63.388129 47.7210656,62.5109944 47.0961388,61.9023964 L38.8800677,53.8798006 C37.6937796,52.729117 37.2653065,51.0038514 37.7754139,49.4318646 C38.2855214,47.8598778 39.6453771,46.7149224 41.2812807,46.4800359 L52.6565637,44.8288707 C53.5198467,44.7035076 54.2661596,44.1613653 54.6522738,43.3791317 L59.7382869,33.0745883 C60.4668101,31.5915301 61.9753348,30.6518559 63.6276689,30.6518559 C65.280003,30.6518559 66.7885277,31.5915301 67.5170509,33.0745883 L72.603064,43.3791317 C72.9891782,44.1613653 73.7354911,44.7035076 74.5987741,44.8288707 L85.9714067,46.4800359 C87.6019797,46.7242706 88.9529404,47.8721547 89.4572585,49.4418942 C89.9615767,51.0116337 89.5319747,52.7315682 88.3487666,53.8798006 L88.3487666,53.8798006 Z" id="Shape"></path>
        </g>
    </g>
</svg>
';
    }

    public static function availableForNavigation(Request $request)
    {

        if (auth()->user()->email == 'fallujahmakerspace@makershive.org') {
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
    public static $model = \App\Models\Contest::class;

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
        'id','name'
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
            Text::make(__('Name'), 'name')->required(),
            Textarea::make(__('Description'), 'description')->required(),
            Date::make(__('Starting Date'), 'date')->sortable()->required(),
            Text::make(__('Prize'), 'prize')->required(),
            Text::make(__('Sponsors'), 'sponsors')->required(),
            Text::make(__('Organizers'), 'organizers')->required(),
            Text::make(__('Partners'), 'partners')->required(),


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
