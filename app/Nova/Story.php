<?php

namespace App\Nova;

use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Story extends Resource
{
    public static function icon()
    {
        return '
<svg class="sidebar-icon" viewBox="0 0 134 128" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Shape-5" transform="translate(2.275960, 1.264861)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M121.971227,71.6257606 L111.369845,71.6257606 C106.978608,71.6257606 103.418808,75.1855609 103.418808,79.5767971 L103.418808,87.5278337 L92.8174261,87.5278337 C88.4261898,87.5278337 84.8663895,91.087634 84.8663895,95.4788702 L84.8663895,103.429907 L78.1345119,103.429907 C79.078048,101.821923 79.5808505,99.9935503 79.592202,98.1292157 L79.592202,66.3250696 C79.592202,64.8613242 78.4056019,63.6747241 76.9418565,63.6747241 L68.9643165,63.6747241 L68.9643165,47.772651 C76.0058194,47.6099036 82.688259,44.6314448 87.516735,39.5035731 C96.713434,29.3527498 95.4677716,13.7687182 95.4677716,13.3181594 C95.4677716,7.46317781 90.7213712,2.7167774 84.8663895,2.7167774 C79.0114079,2.7167774 74.2650075,7.46317781 74.2650075,13.3181594 C74.2650075,13.3181594 74.1324902,26.569887 66.313971,26.569887 L59.6085968,26.569887 C62.2336801,23.6646012 63.6797412,19.8840493 63.6636255,15.9685049 C63.6927111,8.86186534 59.002883,2.59866468 52.1754112,0.626153299 C45.3479394,-1.34635808 38.0405181,1.450741 34.2751341,7.47793402 C30.5097501,13.505127 31.2006299,21.2990256 35.9675149,26.569887 L29.2091339,26.569887 C21.3906146,26.569887 21.2580973,13.4506767 21.2580973,13.3181594 C21.2959724,9.53065043 19.3103585,6.01064166 16.049217,4.08408636 C12.7880755,2.15753107 8.74685151,2.11711883 5.44783495,3.97807254 C2.14881839,5.83902626 0.0932083607,9.31862278 0.0553332707,13.1061318 C0.0553332707,13.7687182 -1.19032912,29.3527498 8.13888707,39.6095869 C12.9662572,44.6368548 19.59067,47.5439712 26.5587884,47.6931407 L26.5587884,111.301433 C26.5587884,117.156415 31.3051888,121.902815 37.1601704,121.902815 C43.015152,121.902815 47.7615524,117.156415 47.7615524,111.301433 L47.7615524,84.7979778 L58.3629345,84.7979778 L58.3629345,98.0497053 C58.3906844,99.9224872 58.9216299,101.753333 59.9001349,103.350396 C55.958882,103.920987 53.0476578,107.319303 53.0887469,111.301433 L53.0887469,116.602124 C53.0887469,120.99336 56.6485472,124.55316 61.0397834,124.55316 L121.971227,124.55316 C126.362463,124.55316 129.922263,120.99336 129.922263,116.602124 L129.922263,79.4972868 C129.878659,75.1371328 126.331599,71.6255426 121.971227,71.6257606 Z M47.7615524,5.36712291 C53.616534,5.36712291 58.3629345,10.1135233 58.3629345,15.9685049 C58.3629345,21.8234866 53.616534,26.569887 47.7615524,26.569887 C41.9065708,26.569887 37.1601704,21.8234866 37.1601704,15.9685049 C37.1601704,10.1135233 41.9065708,5.36712291 47.7615524,5.36712291 Z M29.2091339,42.47196 C22.8311196,42.8237465 16.6110054,40.4091058 12.1409088,35.8460963 C4.37539645,27.5240114 5.35602429,13.6627043 5.35602429,13.3181594 C5.35602426,11.4244049 6.36633025,9.67450356 8.00636977,8.72762629 C9.64640929,7.78074902 11.6670213,7.78074902 13.3070608,8.72762629 C14.9471004,9.67450356 15.9574063,11.4244049 15.9574063,13.3181594 C15.9574063,19.7319956 18.7402691,31.870578 29.2091339,31.870578 L66.313971,31.870578 C76.915353,31.870578 79.5656985,19.7319956 79.5656985,13.3181594 C79.6035736,11.4244049 80.6488776,9.69470972 82.3078547,8.78063326 C83.9668317,7.8665568 85.9874437,7.90696904 87.6085457,8.88664708 C89.2296477,9.86632513 90.2049556,11.6364326 90.1670806,13.5301871 C90.1670806,13.5301871 91.2007153,27.5240114 83.435203,35.9256066 C78.9386611,40.4738119 72.6978958,42.8599869 66.313971,42.47196 C64.8502256,42.47196 63.6636255,43.6585601 63.6636255,45.1223055 L63.6636255,63.6747241 L31.8594794,63.6747241 L31.8594794,45.1223055 C31.8594794,43.6585601 30.6728793,42.47196 29.2091339,42.47196 L29.2091339,42.47196 Z M45.1112069,79.5767971 C43.6474615,79.5767971 42.4608614,80.7633972 42.4608614,82.2271426 L42.4608614,111.380943 C42.4608614,114.308434 40.0876612,116.681634 37.1601704,116.681634 C34.2326796,116.681634 31.8594794,114.308434 31.8594794,111.380943 L31.8594794,68.9754151 L74.2650075,68.9754151 L74.2650075,98.1292157 C74.2650075,101.056707 71.8918073,103.429907 68.9643165,103.429907 C66.0368257,103.429907 63.6636255,101.056707 63.6636255,98.1292157 L63.6636255,82.2271426 C63.6636255,80.7633972 62.4770254,79.5767971 61.01328,79.5767971 L45.1112069,79.5767971 Z M124.621572,116.681634 C124.621572,118.14538 123.434972,119.33198 121.971227,119.33198 L61.01328,119.33198 C59.5495346,119.33198 58.3629345,118.14538 58.3629345,116.681634 L58.3629345,111.380943 C58.3629345,109.917198 59.5495346,108.730598 61.01328,108.730598 L124.621572,108.730598 L124.621572,116.681634 Z M124.621572,103.429907 L90.1670806,103.429907 L90.1670806,95.4788702 C90.1670806,94.0151248 91.3536807,92.8285247 92.8174261,92.8285247 L124.621572,92.8285247 L124.621572,103.429907 Z M124.621572,87.5278337 L108.719499,87.5278337 L108.719499,79.5767971 C108.719499,78.1130517 109.906099,76.9264516 111.369845,76.9264516 L121.971227,76.9264516 C123.434972,76.9264516 124.621572,78.1130517 124.621572,79.5767971 L124.621572,87.5278337 Z" id="Shape"></path>
        </g>
    </g>
</svg>
        ';
    }

    public static function availableForNavigation(Request $request)
    {
        if (auth()->user()->email == 'iotkids@makershive.org') {
            return false;
        } else {
            return true;
        }
    }

    public static function label()
    {
        return 'Success stories';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Story::class;

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
            Filepond::make('Image')->disk('public'),

            Text::make(__('Name'), 'name')->required(),
            Text::make(__('Phone'), 'phone')->required(),
            Text::make(__('Email'), 'email')->required(),
            Textarea::make(__('Story'), 'story')->required(),

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
