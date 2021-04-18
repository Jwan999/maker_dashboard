<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Anaseqal\NovaImport\NovaImport;
use Coroowicaksono\ChartJsIntegration\PieChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Anaseqal\NovaSidebarIcons\NovaSidebarIcons;

use Coroowicaksono\ChartJsIntegration\BarChart;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('iot-maker', asset('/css/theme.css'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new PieChart())
                ->title('Gender')
                ->series(array([

                    'data' => [count(Student::where('gender', 'male')->get()), count(Student::where('gender', 'female')->get())],
                    'backgroundColor' => ["#ffcc5c", "#91e8e1", "#ff6f69", "#88d8b0", "#b088d8", "#d8b088", "#88b0d8", "#6f69ff"],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['Female', 'Male']
                    ],
                ])->width('1/3'),

            (new BarChart())
                ->title('Age Range')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(
                    array([
                        'label' => '',
                        'backgroundColor' => '#F87900',
                        $student = Student::where('age', '!=', null)->get('age'),

                        'data' => [$student->map(function ($student) {
                            return $student->age;
                        })],
                    ]))
                ->options([
                    'xaxis' => [
//                        $student = Student::where('age', '!=', null)->get('age'),
//                        'categories' => [$student->map(function ($student) {
//                            return $student->age;
//                        })],

//                        dd($student),
                    ],
                ])
                ->width('2/3'),

        ];

    }


    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaImport,
            new NovaSidebarIcons,


        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
