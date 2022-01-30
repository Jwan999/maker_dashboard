<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use PosLifestyle\DateRangeFilter\Enums\Config;

class Recommendation extends Resource
{

    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 484 484" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <title>quality (1)</title>
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="quality-(1)" transform="translate(2.000000, 2.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="16">
            <path d="M478.4,235.2 L478.4,235.2 L441.6,185.984 L448.92,124.92 C449.344,121.391 447.389,118.005 444.12,116.608 L387.56,92.488 L363.392,35.912 C361.996,32.643 358.609,30.688 355.08,31.112 L294.016,38.44 L244.8,1.6 C241.956,-0.533 238.044,-0.533 235.2,1.6 L185.984,38.44 L124.928,31.112 C121.399,30.688 118.012,32.643 116.616,35.912 L92.488,92.488 L35.92,116.608 C32.651,118.005 30.696,121.391 31.12,124.92 L38.44,185.984 L1.6,235.2 C-0.533,238.044 -0.533,241.955 1.6,244.8 L38.448,294.016 L31.12,355.08 C30.696,358.609 32.651,361.996 35.92,363.392 L92.48,387.512 L116.608,444.088 C118.004,447.357 121.391,449.312 124.92,448.888 L185.984,441.56 L235.2,478.4 C238.044,480.533 241.956,480.533 244.8,478.4 L294.016,441.6 L355.072,448.928 C358.601,449.352 361.988,447.397 363.384,444.128 L387.512,387.552 L444.08,363.432 C447.349,362.035 449.304,358.649 448.88,355.12 L441.6,294.016 L478.4,244.8 C480.533,241.956 480.533,238.044 478.4,235.2 Z M101.72,374.064 L47.712,351.024 L54.704,292.744 C54.951,290.7 54.401,288.64 53.168,286.992 L17.992,240 L53.192,193.008 C54.425,191.36 54.975,189.3 54.728,187.256 L52.4,168 L120,168 L120,376 L104.392,376 C103.647,375.175 102.736,374.515 101.72,374.064 Z M426.832,287.024 C425.599,288.672 425.049,290.732 425.296,292.776 L432.288,351.056 L378.28,374.096 C376.381,374.904 374.867,376.414 374.056,378.312 L351.024,432.32 L292.744,425.32 C290.702,425.077 288.645,425.63 287,426.864 L240,462.008 L193,426.808 C191.615,425.769 189.931,425.208 188.2,425.208 C187.882,425.207 187.564,425.226 187.248,425.264 L128.968,432.264 L111.792,392 L136,392 L136,376 L336,376 C353.673,375.992 367.994,361.659 367.986,343.986 C367.983,337.656 366.103,331.469 362.584,326.208 C379.261,320.358 388.038,302.096 382.188,285.42 C380.909,281.775 378.981,278.391 376.496,275.432 C378.721,274.083 380.775,272.471 382.616,270.632 C395.024,258.372 395.145,238.375 382.885,225.966 C380.917,223.974 378.693,222.253 376.272,220.848 C381.786,214.454 384.531,206.131 383.904,197.712 C382.292,180.633 367.792,167.681 350.64,168 L272,168 L272,104 C271.974,81.92 254.08,64.026 232,64 L216,64 C211.582,64 208,67.582 208,72 L208,104 C207.96,139.33 179.33,167.96 144,168 L136,168 L136,152 L50.48,152 L47.712,128.976 L101.72,105.936 C103.619,105.128 105.132,103.618 105.944,101.72 L128.976,47.712 L187.256,54.712 C189.298,54.961 191.358,54.408 193,53.168 L240,17.992 L287,53.192 C288.643,54.43 290.702,54.984 292.744,54.736 L351.024,47.736 L374.064,101.744 C374.874,103.64 376.384,105.15 378.28,105.96 L432.288,129 L425.296,187.28 C425.049,189.324 425.599,191.384 426.832,193.032 L462.008,240 L426.832,287.024 Z M264,184 L350.64,184 C359.367,183.767 366.849,190.187 367.944,198.848 C368.321,203.483 366.621,208.045 363.304,211.304 C360.316,214.319 356.244,216.01 352,216 L336,216 C331.582,216 328,219.582 328,224 C328,228.418 331.582,232 336,232 L358.64,232 C367.367,231.767 374.849,238.187 375.944,246.848 C376.321,251.483 374.621,256.045 371.304,259.304 C368.316,262.319 364.244,264.01 360,264 L336,264 C331.582,264 328,267.582 328,272 C328,276.418 331.582,280 336,280 L352,280 C360.837,280 368,287.163 368,296 C368,304.837 360.837,312 352,312 L328,312 C323.582,312 320,315.582 320,320 C320,324.418 323.582,328 328,328 L336,328 C344.837,328 352,335.163 352,344 C352,352.837 344.837,360 336,360 L136,360 L136,184 L144,184 C188.163,183.951 223.951,148.163 224,104 L224,80 L232,80 C245.255,80 256,90.745 256,104 L256,176 C256,180.418 259.582,184 264,184 Z" id="Shape"></path>
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
    public static $model = \App\Models\Recommendation::class;

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
//            BelongsTo::make(__("Recommender"), "recommender", \App\Models\Trainer::class),
            BelongsTo::make('Recommender', 'recommender', 'App\Nova\Trainer')->required(),
            NovaBelongsToDepend::make('Training')->required()
                ->options(\App\Models\Training::all()),
            NovaBelongsToDepend::make('Student')->required()
                ->optionsResolve(function ($training) {
                    return $training->students;
                })
                ->dependsOn('Training')
                ->rules('required'),

//            BelongsTo::make("", "student", Student::Class)->searchable(),
//            BelongsTo::make("Training", "training", Training::Class)->searchable(),
            Textarea::make(__('Recommendation'), 'recommendation')->required(),
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
