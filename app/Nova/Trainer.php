<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;

class Trainer extends Resource
{
    public static function icon()
    {
        return '
      
<svg class="sidebar-icon" viewBox="0 0 124 125" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
   
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Shape-3" transform="translate(1.000000, 1.325185)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="3">
            <path d="M76.8600197,59.3473446 C89.3262278,52.149976 95.4040249,37.4768757 91.6783928,23.5726274 C87.9527607,9.66837903 75.3526838,-2.13162821e-14 60.9579467,-2.13162821e-14 C46.5632096,-2.13162821e-14 33.9631327,9.66837903 30.2375006,23.5726274 C26.5118685,37.4768757 32.5896656,52.149976 45.0558736,59.3473446 C18.8981225,64.4226928 0.00701447425,87.3253832 -1.17239551e-12,113.970965 C-1.17239551e-12,118.362202 3.55980031,121.922002 7.95103653,121.922002 L113.964857,121.922002 C118.356093,121.922002 121.915893,118.362202 121.915893,113.970965 C121.908879,87.3253832 103.017771,64.4226928 76.8600197,59.3473446 L76.8600197,59.3473446 Z M34.4544916,31.8102547 C34.4544916,17.1728007 46.3204926,5.30679965 60.9579467,5.30679965 C75.5954008,5.30679965 87.4614018,17.1728007 87.4614018,31.8102547 C87.4614018,46.4477088 75.5954008,58.3137098 60.9579467,58.3137098 C46.3204926,58.3137098 34.4544916,46.4477088 34.4544916,31.8102547 L34.4544916,31.8102547 Z M113.964857,116.621311 L79.5103653,116.621311 C75.119129,116.621311 71.5593287,113.061511 71.5593287,108.670274 C71.5593287,104.279038 75.119129,100.719238 79.5103653,100.719238 L100.713129,100.719238 C102.176875,100.719238 103.363475,99.5326379 103.363475,98.0688924 C103.363475,96.605147 102.176875,95.4185469 100.713129,95.4185469 L79.5103653,95.4185469 C72.1916382,95.4185469 66.2586377,101.351547 66.2586377,108.670274 C66.243069,111.540058 67.1746579,114.334825 68.9089832,116.621311 L53.0069102,116.621311 C54.7412355,114.334825 55.6728244,111.540058 55.6572557,108.670274 C55.6572557,101.351547 49.7242552,95.4185469 42.4055281,95.4185469 L21.2027641,95.4185469 C19.7390187,95.4185469 18.5524186,96.605147 18.5524186,98.0688924 C18.5524186,99.5326379 19.7390187,100.719238 21.2027641,100.719238 L42.4055281,100.719238 C46.7967644,100.719238 50.3565647,104.279038 50.3565647,108.670274 C50.3565647,113.061511 46.7967644,116.621311 42.4055281,116.621311 L7.95103653,116.621311 C6.48729112,116.621311 5.30069102,115.434711 5.30069102,113.970965 C5.30069102,86.1598028 27.846093,63.6144008 55.6572557,63.6144008 L66.2586377,63.6144008 C94.0698004,63.6144008 116.615202,86.1598028 116.615202,113.970965 C116.615202,115.434711 115.428602,116.621311 113.964857,116.621311 L113.964857,116.621311 Z" id="Shape"></path>
        </g>
    </g>
</svg>
        ';
    }

    public static $priority = 4;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Trainer::class;

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
        'name'
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
            Text::make(__('Name'), 'name')->sortable(),
            Number::make(__('Phone'), 'phone'),
            Text::make(__('Email'), 'email'),
            RadioButton::make(__('Training Type'), 'type')
                ->options([
                    'external' => 'External',
                    'internal' => 'Internal'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ]),

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
