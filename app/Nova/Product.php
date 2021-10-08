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
use OwenMelbz\RadioField\RadioButton;
use Psy\Util\Str;

class Product extends Resource
{
    public static function icon()
    {
        return '
<svg class="sidebar-icon" viewBox="0 0 135 134" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-30" transform="translate(0.999985, 0.998968)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M127.081431,19.8441687 L68.7738302,0.409185107 C67.1396106,-0.136395036 65.3723934,-0.136395036 63.7381738,0.409185107 L5.43057258,19.8441687 C2.1863017,20.9285277 7.30446702e-06,23.966361 7.30446702e-06,27.387052 L7.30446702e-06,104.557162 C-0.00461592678,107.98316 2.18580296,111.026892 5.43587327,112.110647 L63.7434745,131.545631 C65.3778805,132.090063 67.1447249,132.090063 68.7791309,131.545631 L127.086732,112.110647 C130.334708,111.025054 132.522681,107.981754 132.5173,104.557162 L132.5173,27.387052 C132.5173,23.9649555 130.327797,20.9266919 127.081431,19.8441687 Z M67.0935112,41.6962674 C66.5510409,41.8790664 65.9636135,41.8790664 65.4211432,41.6962674 L43.7863728,34.4846773 L98.0760502,15.7626366 L121.486552,23.5652538 L67.0935112,41.6962674 Z M65.4237935,5.43689054 C65.9662638,5.25409159 66.5536912,5.25409159 67.0961615,5.43689054 L89.8096225,13.0062773 L35.5146444,31.728318 L11.033403,23.5652538 L65.4237935,5.43689054 Z M5.30070359,104.557162 L5.30070359,27.387052 C5.30070359,27.3393458 5.31925807,27.2969403 5.32190841,27.2492341 L63.6083068,46.678917 L63.6083068,125.892444 L7.11354198,107.07499 C6.02983607,106.714045 5.29928865,105.699396 5.30070359,104.557162 Z M127.216599,104.557162 C127.216599,105.698421 126.486542,106.711702 125.403763,107.07234 L68.9089979,125.892444 L68.9089979,46.678917 L127.195396,27.2518844 C127.195396,27.2969403 127.216599,27.3393458 127.216599,27.387052 L127.216599,104.557162 Z" id="Shape"></path>
            <path d="M27.2455665,98.7635069 L16.8005548,95.2809529 C15.9010214,94.9812663 14.9099374,95.1842397 14.2006344,95.8134152 C13.4913315,96.4425906 13.1715696,97.4023813 13.3618001,98.3312434 C13.5520305,99.2601055 14.2233527,100.016923 15.1228861,100.316609 L25.5678978,103.799163 C25.8375392,103.891045 26.1205414,103.937615 26.4054069,103.936988 C27.7066545,103.93923 28.8170576,102.996493 29.0259575,101.712121 C29.2348574,100.427749 28.4804542,99.1817049 27.2455665,98.771458 L27.2455665,98.7635069 Z" id="Path"></path>
        </g>
    </g>
</svg>
';
    }

    public static $priority = 6;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

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
            Text::make(__('Name'), 'name'),
            Textarea::make(__('Description'), 'description'),
            Filepond::make('Image')->disk('public'),
//                ->storeAs(function (Request $request) { // this is optional, use in case you need generate custom file names
////                dd($request);
//                return Str::random(20) . '.' . $request->file->getExtension();
//            }
//            ),

            File::make(__('Design file'), 'design')->disk('public')->storeAs(function (Request $request) {
                return 'design.' . now() . '.' . $request->file('design')->getClientOriginalExtension();
            })->nullable(),


            Text::make(__('Materials'), 'materials'),
            Text::make(__('Machines used'), 'machines_used'),

            RadioButton::make(__('Made for'), 'made_for')
                ->options([
                    'Order' => 'Order',
                    'Startup support' => 'Startup support',
                    'Company use' => 'Company use'

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
