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

//        Nova::style('iot-maker', asset('/css/iotkids.css'));
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
                return Carbon::parse($training->date)->format('Y/m');
            })->map->count();

        $courses = Training::where('type', 'course')->get()
            ->groupBy(function ($training) {
                return Carbon::parse($training->date)->format('Y/m');
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
        if (str_contains(url(''), 'iotkids')) {
            $primary = '#46C4F9';
            $primaryDark = '#F172AB';
        } elseif (str_contains(url(''), 'iotmaker')) {
            $primary = '#269DDD';
            $primaryDark = '#fca000';
        } elseif (str_contains(url(''), 'fallujahmakerspace')) {
            $primary = '#269DDD';
            $primaryDark = '#fca000';
        } elseif (str_contains(url(''), 'erbilmakerspace')) {
            $primary = '#000000';
            $primaryDark = '#F04E42';
        } else {
            $primary = '#46C4F9';
            $primaryDark = '#F172AB';
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
                    'borderColor' => $primary,
                    'data' => $sessionsData,
                ], [
                    'barPercentage' => 0.5,
                    'label' => 'Courses',
                    'borderColor' => $primaryDark,
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
            (new HtmlCard())->width('1/3')->view('trainingsAndSessions'),

            (new PieChart())
                ->title('Gender')
                ->series(array([

                    $total = count(Student::get()),
                    $femalePercentage = number_format((float)count(Student::where('gender', 'female')->get()) / $total * 100),
                    $malePercentage = number_format((float)count(Student::where('gender', 'male')->get()) / $total * 100),

                    'data' => [$femalePercentage, $malePercentage],
                    'backgroundColor' => [$primary, $primaryDark],
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
                        'label' => 'Age %',
                        'backgroundColor' => $primary,
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
//            (new students()),
            (new HtmlCard())->width('1/3')->view('students'),

//            (new HtmlCard())->width('1/3')->view('card'),
            (new HtmlCard())->width('1/3')->view('interns'),

//            if (str_contains(url(''), 'iotkids')){
            (new HtmlCard())->width('1/3')->view('services')->canSee(function ($request) {
                if (str_contains(url(''), 'iotkids')) {
                    return false;
                } else if (str_contains(url(''), 'iotmaker')) {
                    return true;
                } else if (str_contains(url(''), 'fallujahmakerspace')) {
                    return false;
                }
            }),

//            }


            (new HtmlCard())->width('1/3')->view('products'),
            (new HtmlCard())->width('1/3')->view('trainers'),

            (new HtmlCard())->width('1/3')->view('startups')->canSee(function ($request) {
                if (str_contains(url(''), 'iotkids')) {
                    return false;
                } else if (str_contains(url(''), 'iotmaker')) {
                    return true;
                } else if (str_contains(url(''), 'fallujahmakerspace')) {
                    return false;
                }

            }),


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
//            new \Czemu\NovaCalendarTool\NovaCalendarTool,


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
