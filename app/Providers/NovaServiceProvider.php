<?php

namespace App\Providers;

use App\Models\Student;
use App\Nova\Metrics\governorate;
use App\Nova\Metrics\students;
use App\Nova\StudentsLocation;
use IDF\HtmlCard\HtmlCard;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Anaseqal\NovaImport\NovaImport;
use Coroowicaksono\ChartJsIntegration\PieChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\ScatterChart;
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
//        dd($student);

        $dataChart1 = [];
        $dataChart2 = [];
        for ($i = 0; $i <= 50; $i++) {
            $dataChart1[$i] = [
                'x' => rand(-25, 25),
                'y' => rand(-25, 25),
            ];
            $dataChart2[$i] = [
                'x' => rand(-25, 25),
                'y' => rand(-25, 25),
            ];
        }

        return [
            (new LineChart())
                ->title('Trainings per month')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Sessions',
                    'borderColor' => '#677DEA',
                    'data' => [3, 2, 4, 3, 5, 2, 5, 4, 4, 3, 1, 3],
                ], [
                    'barPercentage' => 0.5,
                    'label' => 'Courses',
                    'borderColor' => '#1B1F2C',
                    'data' => [0, 1, 2, 0, 1, 0, 0, 1, 0, 0, 0, 0],
                ]))
                ->options([
                    'layout' => [
                        'padding' => [
                            'left' => 8,
                            'right' => 8,
                            'top' => 8,
                            'bottom' => 8
                        ],
                    ],
                    'xaxis' => [
                        'categories' => ['Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
                    ],
                ])
                ->width('2/3'),

            (new PieChart())
                ->title('Gender')
                ->series(array([

                    'data' => [count(Student::where('gender', 'male')->get()), count(Student::where('gender', 'female')->get())],
                    'backgroundColor' => ["#EC4899", "#414F8B"],
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
                        $studentsAges = Student::all()->groupBy('age')->map->count(),

                        'label' => 'Age',
                        'backgroundColor' => '#677DEA',
//dd($studentsAges),
                        'data' => [
                            Student::whereBetween('age', ['15', '19'])->count(), Student::whereBetween('age', ['19', '25'])->count(), Student::whereBetween('age', ['25', '35'])->count()
                        ],
                    ]))
                ->options([
                    'xaxis' => [
//                        $studentsAges = Student::all()->groupBy('age')->map->count(),
//                        dd($studentsAges),
                        'categories' => [
//                          $studentsAges->keys()
                            "15-19", "19-25", "25-35"

                        ],


//                        dd($student),
                    ],
                ])
                ->width('2/3'),

            (new HtmlCard())->width('1/3')->view('card'),
            (new students()),
//            (new StudentsLocation)

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
