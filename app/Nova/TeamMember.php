<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class TeamMember extends Resource
{
    public static function icon()
    {
        return '
        
<svg class="sidebar-icon" viewBox="0 0 480 480" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="partnership" transform="translate(2.000000, 2.000000)" fill="var(--sidebar-icon)" fill-rule="nonzero" stroke="var(--sidebar-icon)" stroke-width="10">
            <path d="M390,368.745 C378.632918,368.712951 367.558287,372.345932 358.419,379.105 L327.657,348.343 C317.893133,338.662793 302.140934,338.69668 292.418807,348.418807 C282.69668,358.140934 282.662793,373.893133 292.343,383.657 L298.686,390 L246,390 L246,339.155 C246.000207,335.827752 243.940979,332.847732 240.82866,331.671276 C237.71634,330.494819 234.200768,331.367564 232,333.863 C225.400808,341.355428 214.852315,343.979645 205.511751,340.452655 C196.171187,336.925664 189.989858,327.984278 189.989858,318 C189.989858,308.015722 196.171187,299.074336 205.511751,295.547345 C214.852315,292.020355 225.400808,294.644572 232,302.137 C234.200768,304.632436 237.71634,305.505181 240.82866,304.328724 C243.940979,303.152268 246.000207,300.172248 246,296.845 L246,246 L281.347,246 C274.020759,262.764798 279.002946,282.363473 293.445967,293.594297 C307.888988,304.825121 328.111012,304.825121 342.554033,293.594297 C356.997054,282.363473 361.979241,262.764798 354.653,246 L390,246 L390,350 L406,350 L406,198 L430,198 C447.664888,197.98016 461.98016,183.664888 462,166 L462,97.314 L475.657,83.657 L464.343,72.343 L448.343,88.343 C446.842727,89.8433506 445.999923,91.8782385 446,94 L446,166 C445.98953,174.832216 438.832216,181.98953 430,182 L406,182 L406,161.314 L419.657,147.657 L408.343,136.343 L372.343,172.343 C368.839858,175.846142 363.160142,175.846142 359.657,172.343 C356.153858,168.839858 356.153858,163.160142 359.657,159.657 L395.657,123.657 C397.15738,122.156697 398.000292,120.121803 398.000292,118 C398.000292,115.878197 397.15738,113.843303 395.657,112.343 C381.133169,97.7838138 381.133169,74.2161862 395.657,59.657 L435.657,19.657 L424.343,8.343 L384.343,48.343 C365.763349,66.9720658 363.54161,96.3658428 379.11,117.576 L348.343,148.343 C341.989444,154.642117 339.491427,163.859013 341.794652,172.504342 C344.097876,181.14967 350.85033,187.902124 359.495658,190.205348 C368.140987,192.508573 377.357883,190.010556 383.657,183.657 L390,177.314 L390,230 L339.154,230 C335.826752,229.999793 332.846732,232.059021 331.670276,235.17134 C330.493819,238.28366 331.366564,241.799232 333.862,244 C341.354977,250.598937 343.979707,261.147616 340.45289,270.488506 C336.926073,279.829396 327.984521,286.011023 318,286.011023 C308.015479,286.011023 299.073927,279.829396 295.54711,270.488506 C292.020293,261.147616 294.645023,250.598937 302.138,244 C304.633436,241.799232 305.506181,238.28366 304.329724,235.17134 C303.153268,232.059021 300.173248,229.999793 296.846,230 L246,230 L246,194.654 C262.764687,201.978946 282.362377,196.996141 293.59252,182.553376 C304.822662,168.110611 304.822662,147.889389 293.59252,133.446624 C282.362377,119.003859 262.764687,114.021054 246,121.346 L246,86 L350,86 L350,70 L198,70 L198,46 C197.98016,28.3351123 183.664888,14.0198395 166,14 L97.313,14 L83.657,0.343 L72.343,11.657 L88.343,27.657 C89.8433506,29.1572733 91.8782385,30.0000773 94,30 L166,30 C174.832216,30.0104696 181.98953,37.1677843 182,46 L182,70 L161.314,70 L147.657,56.343 L136.343,67.657 L172.343,103.657 C174.609136,105.923136 175.494162,109.2261 174.664699,112.321699 C173.835236,115.417298 171.417298,117.835236 168.321699,118.664699 C165.2261,119.494162 161.923136,118.609136 159.657,116.343 L123.657,80.343 C122.156697,78.8426198 120.121803,77.9997085 118,77.9997085 C115.878197,77.9997085 113.843303,78.8426198 112.343,80.343 C105.356484,87.3297518 95.8805927,91.254888 86,91.254888 C76.1194073,91.254888 66.6435163,87.3297518 59.657,80.343 L19.657,40.343 L8.343,51.657 L48.343,91.657 C66.960008,110.266056 96.376273,112.491459 117.581,96.895 L148.343,127.657 C158.106867,137.337207 173.859066,137.30332 183.581193,127.581193 C193.30332,117.859066 193.337207,102.106867 183.657,92.343 L177.314,86 L230,86 L230,136.845 C229.999793,140.172248 232.059021,143.152268 235.17134,144.328724 C238.28366,145.505181 241.799232,144.632436 244,142.137 C250.599192,134.644572 261.147685,132.020355 270.488249,135.547345 C279.828813,139.074336 286.010142,148.015722 286.010142,158 C286.010142,167.984278 279.828813,176.925664 270.488249,180.452655 C261.147685,183.979645 250.599192,181.355428 244,173.863 C241.799232,171.367564 238.28366,170.494819 235.17134,171.671276 C232.059021,172.847732 229.999793,175.827752 230,179.155 L230,230 L194.653,230 C201.979241,213.235202 196.997054,193.636527 182.554033,182.405703 C168.111012,171.174879 147.888988,171.174879 133.445967,182.405703 C119.002946,193.636527 114.020759,213.235202 121.347,230 L86,230 L86,126 L70,126 L70,278 L46,278 C28.3351123,278.01984 14.0198395,292.335112 14,310 L14,378.686 L0.343,392.343 L11.657,403.657 L27.657,387.657 C29.1572733,386.156649 30.0000773,384.121762 30,382 L30,310 C30.0104696,301.167784 37.1677843,294.01047 46,294 L70,294 L70,314.686 L56.343,328.343 L67.657,339.657 L103.657,303.657 C105.923136,301.390864 109.2261,300.505837 112.321699,301.335301 C115.417298,302.164764 117.835236,304.582702 118.664699,307.678301 C119.494163,310.7739 118.609136,314.076864 116.343,316.343 L80.343,352.343 C78.8426198,353.843303 77.9997085,355.878197 77.9997085,358 C77.9997085,360.121803 78.8426198,362.156697 80.343,363.657 C94.8668308,378.216186 94.8668308,401.783814 80.343,416.343 L40.343,456.343 L51.657,467.657 L91.657,427.657 C110.236651,409.027934 112.45839,379.634157 96.89,358.424 L127.657,327.657 C134.010556,321.357883 136.508573,312.140987 134.205348,303.495658 C131.902124,294.85033 125.14967,288.097876 116.504342,285.794652 C107.859013,283.491427 98.6421168,285.989444 92.343,292.343 L86,298.686 L86,246 L136.846,246 C140.173248,246.000207 143.153268,243.940979 144.329724,240.82866 C145.506181,237.71634 144.633436,234.200768 142.138,232 C134.645023,225.401063 132.020293,214.852384 135.54711,205.511494 C139.073927,196.170604 148.015479,189.988977 158,189.988977 C167.984521,189.988977 176.926073,196.170604 180.45289,205.511494 C183.979707,214.852384 181.354977,225.401063 173.862,232 C171.366564,234.200768 170.493819,237.71634 171.670276,240.82866 C172.846732,243.940979 175.826752,246.000207 179.154,246 L230,246 L230,281.346 C213.235313,274.021054 193.637623,279.003859 182.40748,293.446624 C171.177338,307.889389 171.177338,328.110611 182.40748,342.553376 C193.637623,356.996141 213.235313,361.978946 230,354.654 L230,390 L126,390 L126,406 L278,406 L278,430 C278.01984,447.664888 292.335112,461.98016 310,462 L378.687,462 L392.343,475.657 L403.657,464.343 L387.657,448.343 C386.156649,446.842727 384.121762,445.999923 382,446 L310,446 C301.167784,445.98953 294.01047,438.832216 294,430 L294,406 L314.686,406 L328.343,419.657 L339.657,408.343 L303.657,372.343 C301.390864,370.076864 300.505837,366.7739 301.3353,363.678301 C302.164764,360.582702 304.582702,358.164764 307.678301,357.3353 C310.7739,356.505837 314.076864,357.390864 316.343,359.657 L352.343,395.657 C353.843303,397.15738 355.878197,398.000292 358,398.000292 C360.121803,398.000292 362.156697,397.15738 363.657,395.657 C370.643516,388.670248 380.119407,384.745112 390,384.745112 C399.880593,384.745112 409.356484,388.670248 416.343,395.657 L456.343,435.657 L467.657,424.343 L427.657,384.343 C417.691517,374.323208 404.131723,368.706572 390,368.745 L390,368.745 Z" id="Path"></path>
        </g>
    </g>
</svg>

 ';
    }


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TeamMember::class;

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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')->sortable(),
            Text::make(__('Residence'), 'residence')->sortable(),
            Number::make(__('Phone'), 'phone'),
            Text::make(__('Email'), 'email'),
            Date::make(__('Employment date'), 'employment_date')->sortable(),
            Textarea::make(__('Recent Accomplishment'), 'recent_accomplishment'),
            Textarea::make(__('Qualifications'), 'qualifications'),
            Textarea::make(__('Past Positions'), 'past_positions'),
            Textarea::make(__('Philosophy'), 'philosophy'),

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