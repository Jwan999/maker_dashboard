<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;
use Dniccum\PhoneNumber\PhoneNumber;


class Student extends Resource
{
    public static function icon()
    {
        return '
      
<svg class="sidebar-icon" viewBox="0 0 104 135" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
   
    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Shape-2" transform="translate(1.252880, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="3">
            <path d="M27.1384411,55.6572557 C26.7845007,55.0462881 26.6889857,54.3193446 26.8730842,53.6376827 C27.0571826,52.9560208 27.5056738,52.3759987 28.119069,52.0262823 C29.3858789,51.3070096 30.9957315,51.7449842 31.7235389,53.0069102 C34.5344202,57.8789509 39.1660146,61.4344405 44.5989443,62.8908434 C50.031874,64.3472463 55.8208685,63.5851991 60.6918153,60.7724225 C63.9173965,58.9108394 66.5957445,56.2324914 68.4573276,53.0069102 C68.8070439,52.393515 69.3870661,51.9450238 70.068728,51.7609254 C70.7503899,51.5768269 71.4773334,51.6723419 72.0883009,52.0262823 C72.6972023,52.3804427 73.1400688,52.9624298 73.3190911,53.6437091 C73.4981134,54.3249884 73.3985627,55.0495085 73.0424253,55.6572557 C68.307863,63.8567961 59.5587247,68.9078171 50.0904332,68.9078171 C40.6221418,68.9078171 31.8730034,63.8567961 27.1384411,55.6572557 L27.1384411,55.6572557 Z M92.4959614,42.4055281 L92.4959614,102.753895 C92.9200166,103.389978 93.3175685,104.026061 93.7151203,104.688648 C97.0635174,110.455406 99.2176862,116.836793 100.049446,123.453094 C100.373896,125.746955 99.6817489,128.068244 98.1540341,129.809839 C96.6263192,131.551434 94.4149899,132.540107 92.0984095,132.517662 L8.02945001,132.517662 C5.71286969,132.540107 3.50154035,131.551434 1.97382548,129.809839 C0.446110614,128.068244 -0.246036025,125.746955 0.0784134817,123.453094 C0.987896959,116.072475 3.56160896,108.994767 7.60539473,102.753895 L7.60539473,42.4055281 C7.60539473,18.9856016 26.5909964,5.68434189e-14 50.0109229,5.68434189e-14 C73.4308494,5.68434189e-14 92.416451,18.9856016 92.416451,42.4055281 L92.4959614,42.4055281 Z M50.0904332,84.8110563 C46.6083067,84.8235573 43.139486,85.2415946 39.7540857,86.0567187 L50.0904332,94.6173346 L60.4267807,86.0567187 C57.0416808,85.2399279 53.5726641,84.8218669 50.0904332,84.8110563 L50.0904332,84.8110563 Z M14.8143345,30.9560355 C19.1529234,29.4050234 22.3744696,25.7117867 23.3219436,21.2027641 L19.6909702,21.2027641 C17.5969555,24.1977286 15.9538973,27.483845 14.8143345,30.9560355 L14.8143345,30.9560355 Z M12.9855961,42.4055281 C12.9855961,62.8979638 29.5979975,79.5103653 50.0904332,79.5103653 C70.5828689,79.5103653 87.1952703,62.8979638 87.1952703,42.4055281 C87.1890124,40.6304145 87.0472488,38.8583687 86.7712151,37.1048371 L42.1393967,37.1048371 C40.6756513,37.1048371 39.4890512,35.918237 39.4890512,34.4544916 C39.4959051,28.0707346 34.9504081,22.5894 28.6756415,21.4147917 C27.4244622,29.2702869 21.3047186,35.4539999 13.4626583,36.7867957 C13.1558488,38.644212 12.9963313,40.5229734 12.9855961,42.4055281 L12.9855961,42.4055281 Z M50.0904332,5.30069102 C40.3972415,5.31313345 31.0937603,9.11823822 24.1700542,15.9020731 L26.2373236,15.9020731 C35.4615313,15.8997054 43.2864743,22.6745479 44.604218,31.8041461 L85.6315665,31.8041461 C80.9450184,16.0849796 66.4933559,5.30819922 50.0904332,5.30069102 L50.0904332,5.30069102 Z M12.9855961,95.862997 C18.9435728,89.4133473 26.466003,84.6114076 34.8244431,81.9221797 C25.548659,78.3194902 17.8236691,71.588249 12.9855961,62.8926989 L12.9855961,95.862997 Z M8.02945001,127.216866 L21.2811775,127.216866 L23.6399851,108.346124 C23.8156345,106.882379 25.1446266,105.838171 26.608372,106.01382 C28.0721174,106.18947 29.1163255,107.518462 28.9406761,108.982207 L26.5818686,127.216866 L47.4400877,127.216866 L47.4400877,99.3084462 L33.7378014,87.938464 C24.2005395,91.6446416 16.2088032,98.4866895 11.0773473,107.338993 C8.07322976,112.493025 6.13545698,118.198189 5.3791045,124.11568 C5.24497354,124.892701 5.46378866,125.689098 5.9761018,126.288504 C6.48841495,126.887911 7.24102074,127.228076 8.02945001,127.216866 Z M89.1300226,107.338993 C83.9985667,98.4866895 76.0068304,91.6446416 66.4695685,87.938464 L52.7407787,99.3084462 L52.7407787,127.216866 L73.5989979,127.216866 L71.3197007,108.982207 C71.1440513,107.518462 72.1882594,106.18947 73.6520048,106.01382 C75.1157502,105.838171 76.4447423,106.882379 76.6203918,108.346124 L78.9261924,127.216866 L92.1779199,127.216866 C92.9663492,127.228076 93.718955,126.887911 94.2312681,126.288504 C94.7435812,125.689098 94.9623964,124.892701 94.8282654,124.11568 C94.0579684,118.201423 92.1211107,112.498953 89.1300226,107.338993 L89.1300226,107.338993 Z M87.1952703,62.8926989 C82.3642551,71.593964 74.6369029,78.3272636 65.3564234,81.9221797 C73.7200332,84.6004084 81.2450945,89.4040276 87.1952703,95.862997 L87.1952703,62.8926989 Z" id="Shape"></path>
        </g>
    </g>
</svg>
        ';
    }

    public static $priority = 8;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Student::class;

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
        'email',
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

            Text::make(__('Phone Number'), 'phone'),
            BelongsToManyField::make('Training', 'trainings', 'App\Nova\Training')->options(\App\Models\Training::select('name', 'date')->get()),
//            dd(\App\Models\Training::select('name', 'date')->get()),
            Text::make(__('University'), 'university'),

            Text::make(__('Email'), 'email'),
//            BelongsToMany::make('Trainings'),

            RadioButton::make(__('Gender'), 'gender')
                ->options([
                    'Female' => 'Female',
                    'Male' => 'Male'
                ])
                ->stack() // optional (required to show hints)
                ->marginBetween() // optional
                ->skipTransformation() // optional
                ->toggle([  // optional
                    1 => ['max_skips', 'skip_sponsored'] // will hide max_skips and skip_sponsored when the value is 1
                ]),

            Text::make(__('Field of study'), 'field_of_study'),
            Text::make(__('Age'), 'age'),
            Select::make(__('Governorate'), 'governorate')->options([
                'Baghdad' => 'Baghdad',
                'Other' => 'Other'
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
