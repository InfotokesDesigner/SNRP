<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'SNRP')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- Cabeçalho --}}
    @include('partials.snrp-header')

    {{-- Menu lateral --}}
    @include('partials.snrp-sidebar')

    {{-- Conteúdo --}}
    <main class="app-main">

        <div class="app-content-header">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-6">

                        <h3 class="mb-0">
                            @yield('page-title', 'Dashboard')
                        </h3>

                    </div>

                </div>

            </div>

        </div>

        <div class="app-content">

            <div class="container-fluid">

                @yield('content')

            </div>

        </div>

    </main>

    {{-- Rodapé --}}
    @include('partials.snrp-footer')

</div>

</body>

</html>