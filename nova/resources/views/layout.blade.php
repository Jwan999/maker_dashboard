<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"--}}
{{--          rel="stylesheet">--}}

<!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <!-- Tool Styles -->
    @foreach(\Laravel\Nova\Nova::availableStyles(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
        @endif
    @endforeach

<!-- Custom Meta Data -->
    @include('nova::partials.meta')

<!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
</head>

<body class="min-w-site bg-40 text-90 font-medium min-h-full">
<div id="nova">
    <div v-cloak class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="min-h-screen flex-none pt-header min-h-screen w-sidebar bg-grad-sidebar px-6">
            <a href="{{ \Laravel\Nova\Nova::path() }}">
                <div class="absolute pin-t pin-l pin-r bg-logo flex items-center w-sidebar h-header px-6 text-white text-lg">
                    @include('nova::partials.logo')
                </div>
            </a>

            @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                {!! $tool->renderNavigation() !!}
            @endforeach
        </div>

        <!-- Content -->
        <div class="content">
            <div class="flex items-center relative shadow h-header bg-white z-20 px-view">
                <a v-if="@json(\Laravel\Nova\Nova::name() !== null)"
                   href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}"
                   class="no-underline dim font-bold text-90 mr-6">
                    {{ \Laravel\Nova\Nova::name() }}
                </a>

                @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
                    <global-search dusk="global-search-component"></global-search>
                @endif

                <dropdown class="ml-auto h-9 flex items-center dropdown-right">
                    @include('nova::partials.user')
                </dropdown>
            </div>


            <div data-testid="content" class="px-view py-view mx-auto">
                @yield('content')

                @if (str_contains(url(''), 'iotkids'))
                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} IoT Kids

                    </div>

                @elseif (str_contains(url(''), 'makersiq'))
                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">
                        {{--                                            <a href="https://nova.laravel.com" class="text-primary dim no-underline">Laravel Nova</a>--}}
                        {{--    <span class="px-1">&middot;</span>--}}
                        &copy; {{ date('Y') }} Makers
                        {{--                        <div class="w-16 mx-4">--}}
                        {{--                            <img src="/fieldready.png" alt="test">--}}
                        {{--                        </div>--}}
                        {{--    <span class="px-1">&middot;<    /span>--}}
                        {{--                        v{{ \Laravel\Nova\Nova::version() }}--}}
                    </div>

                @elseif(str_contains(url(''), 'fallujahmakerspace'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} Fallujah Maker Space

                    </div>
                @elseif(str_contains(url(''), 'maarifmakerspace'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} Maarif Maker Space

                    </div>
                @elseif(str_contains(url(''), 'makerchi'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} Makerchi Maker Space

                    </div>
                @elseif(str_contains(url(''), '3dworld'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} 3D World Maker Space

                    </div>
                @elseif(str_contains(url(''), 'sulimakerspace'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} Suli Maker Space

                    </div>
                @elseif(str_contains(url(''), 'erbilmakerspace'))

                    <div class="mt-8 flex justify-center text-center text-lg text-80 items-end">

                        &copy; {{ date('Y') }} Erbil Maker Space

                    </div>

                @else
                    You Not A Maker

                @endif




                @include('nova::partials.footer')
            </div>


        </div>
    </div>
</div>

<script>
    window.config = @json(\Laravel\Nova\Nova::jsonVariables(request()));
</script>

<!-- Scripts -->
<script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
<script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
<script src="{{ mix('app.js', 'vendor/nova') }}"></script>

<!-- Build Nova Instance -->
<script>
    window.Nova = new CreateNova(config)
</script>

<!-- Tool Scripts -->
@foreach (\Laravel\Nova\Nova::availableScripts(request()) as $name => $path)
    @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
        <script src="{!! $path !!}"></script>
    @else
        <script src="/nova-api/scripts/{{ $name }}"></script>
    @endif
@endforeach

<!-- Start Nova -->
<script>
    Nova.liftOff()
</script>
</body>
</html>
