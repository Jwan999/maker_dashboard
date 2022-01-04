<?php

namespace App\Nova;

use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use OwenMelbz\RadioField\RadioButton;

class Service extends Resource
{

    public static function icon()
    {
        return '

<svg class="sidebar-icon" viewBox="0 0 124 156" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Wireframe" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Group-13" transform="translate(1.000000, 1.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="6">
            <path d="M115.001453,106.879809 C108.362858,102.715666 99.6226023,104.497882 95.1462541,110.928459 C88.6812684,120.198786 78.0937165,125.728132 66.7884037,125.738339 L66.6419035,125.738339 C68.9913812,122.235955 69.2176474,117.724112 67.230352,114.004431 C65.2430567,110.28475 61.3659809,107.963263 57.1472771,107.96696 L7.61963695,107.96696 C3.41333094,107.97155 0.00459136883,111.378799 0,115.583265 L0,146.048486 C0.00459136883,150.252952 3.41333094,153.660202 7.61963695,153.664873 L71.5209094,153.664873 C90.9902634,153.6979 109.122608,143.770398 119.577706,127.353579 C121.706061,124.03726 122.419934,120.00815 121.560455,116.162912 C120.700976,112.317675 118.33946,108.975368 115.001453,106.879809 Z M5.07975796,146.048486 L5.07975796,115.583265 C5.081577,114.181896 6.21765468,113.046315 7.61963695,113.044497 L17.7791529,113.044497 L17.7791529,148.587254 L7.61963695,148.587254 C6.21765468,148.585436 5.081577,147.449855 5.07975796,146.048486 Z M115.301565,124.613995 C105.777216,139.570919 89.2583766,148.616247 71.5209094,148.587324 L22.8589108,148.587324 L22.8589108,113.044497 L57.1472771,113.044497 C60.6541182,113.044497 63.4969745,115.88611 63.4969745,119.391418 C63.4969745,122.896726 60.6541182,125.738339 57.1472771,125.738339 L35.5583057,125.738339 C34.1555693,125.738339 33.0184268,126.874984 33.0184268,128.277107 C33.0184268,129.67923 34.1555693,130.815876 35.5583057,130.815876 L66.7884037,130.815876 C79.7541431,130.805059 91.8972643,124.464908 99.3132304,113.834054 C102.331957,109.529951 108.243786,108.43651 112.603433,111.375921 C116.96308,114.315332 118.163279,120.203927 115.301565,124.613893 L115.301565,124.613995 Z" id="Shape" transform="translate(60.957947, 129.149260) scale(-1, 1) translate(-60.957947, -129.149260) "></path>
            <path d="M41.8715942,7.2199121e-06 L41.860976,7.2199121e-06 C28.1332015,-0.00423314791 15.5158294,7.54545328 9.02626991,19.6468737 C2.53671043,31.7482941 3.22701735,46.439629 10.822684,57.8787383 C12.3862211,60.2257783 14.2076392,62.3902344 16.2528723,64.3316247 C20.0634499,67.804482 22.5037345,72.5284579 23.1311729,77.6468448 L20.138422,77.6468448 C18.4237221,77.6468449 17.0336833,79.0373917 17.0336833,80.752718 C17.0336833,82.4680444 18.4237221,83.8585912 20.138422,83.8585913 L23.5236119,83.8585913 C25.0283924,92.822541 32.7854466,99.3879566 41.8715942,99.3879566 C50.9577417,99.3879566 58.714796,92.822541 60.2195765,83.8585913 L63.6047664,83.8585913 C65.3194663,83.8585913 66.7095053,82.4680445 66.7095053,80.752718 C66.7095053,79.0373916 65.3194663,77.6468448 63.6047664,77.6468448 L60.6117981,77.6468448 C61.2378178,72.5295293 63.6772097,67.8063569 67.4871803,64.3346685 C69.5358677,62.3895023 71.3604008,60.2209838 72.9266828,57.8696381 C80.5193275,46.4283865 81.2055251,31.7367009 74.7123934,19.6370707 C68.2192617,7.53744055 55.5994789,-0.00852027799 41.8715942,7.2199121e-06 Z M41.8715942,93.1762109 C36.2108034,93.1685968 31.2685937,89.3395292 29.8452639,83.8585913 L53.8979245,83.8585913 C52.4745947,89.3395292 47.5323849,93.1685968 41.8715942,93.1762109 L41.8715942,93.1762109 Z M34.4083918,44.1267703 C39.2125448,45.9739267 44.5306436,45.9739267 49.3347966,44.1267703 C46.7742955,55.1268743 45.3266853,66.3567916 45.0138383,77.6468448 L38.72935,77.6468448 C38.4165031,66.3567916 36.9688929,55.1268743 34.4083918,44.1267703 Z M67.7631295,54.4211249 C66.4541616,56.3860668 64.9297172,58.1984689 63.2181954,59.8245679 C58.1555803,64.4573465 55.0015679,70.8119838 54.3724217,77.6468448 L51.2089412,77.6468448 C51.6764352,64.2904076 53.7100429,51.0350786 57.2679943,38.1531201 C57.665598,36.7920292 57.09218,35.3342629 55.8739862,34.6092167 C54.6557925,33.8841705 53.1015314,34.0755819 52.0954993,35.0745475 C49.3847691,37.7885564 45.7068567,39.3134633 41.8716873,39.3134633 C38.036518,39.3134633 34.3586056,37.7885564 31.6478753,35.0745475 C30.6416405,34.0763082 29.087838,33.8853196 27.86996,34.6101778 C26.6520821,35.3350361 26.0785114,36.7921976 26.4753803,38.1531201 C30.0332688,51.0350862 32.0668139,64.290415 32.5342472,77.6468448 L29.3707667,77.6468448 C28.7404485,70.8110762 25.58605,64.4556801 20.5234096,59.8214309 C9.17570261,49.0912007 7.56612841,31.5970262 16.7652784,18.9749742 C22.6042791,10.9444899 31.9360003,6.19883466 41.8624973,6.21173454 L41.8715942,6.21173454 C53.3086391,6.20373576 63.8234706,12.4881183 69.2363912,22.5668353 C74.6493118,32.6455524 74.0832159,44.8854563 67.7631295,54.4211249 Z" id="Shape"></path>
        </g>
    </g>
</svg>
';
    }

    public static function availableForNavigation(Request $request)
    {
        if (auth()->user()->email == 'iotkids@makershive.org') {
            return false;
        }
        else if (auth()->user()->email == 'fallujahmakerspace@makershive.org') {
            return false;
        }

        else {
            return true;
        }
    }


    public static $priority = 7;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Service::class;

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
            Text::make(__('Name'), 'name')->required(),
            Textarea::make(__('Description'), 'description')->required(),
            Text::make(__('Beneficiary'), 'beneficiary')->required(),
            Text::make(__('Price'), 'price')->required(),

            File::make(__('File'), 'file')->disk('public')->storeAs(function (Request $request) {
                return 'file.' . now() . '.' . $request->file('file')->getClientOriginalExtension();
            })->nullable()->required(),

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
