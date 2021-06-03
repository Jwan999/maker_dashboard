<?php

namespace App\Providers;

use App\Models\Student;
use App\Models\Trainer;
use App\Models\Training;
use App\Nova\Metrics\governorate;
use App\Nova\Metrics\students;
use App\Nova\Product;
use App\Nova\Session;
use App\Nova\StudentsLocation;
use Carbon\Carbon;
use IDF\HtmlCard\HtmlCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Anaseqal\NovaImport\NovaImport;
use Coroowicaksono\ChartJsIntegration\PieChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\ScatterChart;
use Anaseqal\NovaSidebarIcons\NovaSidebarIcons;
use Bakerkretzmar\NovaSettingsTool\SettingsTool;
use Techouse\TotalRecords\TotalRecords;


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
        Nova::style('iot-maker', asset('/css/iotmaker.css'));
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
//        dd(Training::select('date')->get());
        $coursesData = [];
        $sessionsData = [];
        $combined = [];
        $sessions = Training::where('type', 'session')->get()
            ->groupBy(function ($training) {
                return Carbon::parse($training->date)->format('Y M');
            })->map->count();

        $courses = Training::where('type', 'course')->get()
            ->groupBy(function ($training) {
                return Carbon::parse($training->date)->format('Y M');
            })->map->count();


        foreach ($sessions as $key => $value) {
            $exists = array_key_exists($key, $combined);
            if ($exists) {
                $combined[$key] = $combined[$key] + $value;
            } else {
                $combined[$key] = $value;
            }
        }
        foreach ($courses as $key => $value) {
            $exists = array_key_exists($key, $combined);
            if ($exists) {
                $combined[$key] = $combined[$key] + $value;
            } else {
                $combined[$key] = $value;
            }
        }


        $months = array_keys($combined);
sort($months);
sort($combined);
        foreach ($months as $month) {
            /** @var Collection $sessions */

            $sessionsData[] = $sessions->has($month) ? $sessions[$month] : 0;
            $coursesData[] = $courses->has($month) ? $courses[$month] : 0;
        }


//        dd($coursesData,$sessionsData,$months);
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
                    'borderColor' => '#fca000',
                    'data' => $sessionsData,
                ], [
                    'barPercentage' => 0.5,
                    'label' => 'Courses',
                    'borderColor' => '#269DDD',
                    'data' => $coursesData,
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
                        'categories' => $months
                    ],
                ])
                ->width('2/3'),

            (new PieChart())
                ->title('Gender')
                ->series(array([

                    $total = count(Student::get()),
                    $femalePercentage = number_format((float)count(Student::where('gender', 'female')->get()) / $total * 100),
                    $malePercentage = number_format((float)count(Student::where('gender', 'male')->get()) / $total * 100),

                    'data' => [$femalePercentage, $malePercentage],
                    'backgroundColor' => ["#fca000", "#269DDD"],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => ['Female: ' . $femalePercentage . "%", 'Male: ' . $malePercentage . "%"]
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
                        'label' => 'Age %:',
                        'backgroundColor' => '#269DDD',
//dd($studentsAges),
                        $totalAge = count(Student::get()),
                        $young = Student::whereBetween('age', ['15', '19'])->count() / $totalAge * 100,
                        $old = Student::whereBetween('age', ['19', '25'])->count() / $totalAge * 100,
                        $older = Student::whereBetween('age', ['25', '35'])->count() / $totalAge * 100,

                        'data' => [
                            number_format($young), number_format($old), number_format($older)
                        ],
                    ]))
                ->options([
                    'xaxis' => [
//                        $studentsAges = Student::all()->groupBy('age')->map->count(),
//                        dd($studentsAges),
                        'categories' => [
//                          $studentsAges->keys()
                            "percent of 15-19", "percent of 19-25 ", "percent of 25-35"

                        ],


//                        dd($student),
                    ],
                ])
                ->width('2/3'),
            (new students()),
            (new HtmlCard())->width('1/3')->view('card'),
            (new HtmlCard())->width('1/3')->view('trainers'),
            (new HtmlCard())->width('1/3')->view('interns'),


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
            new SettingsTool,


        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });
    }
}
