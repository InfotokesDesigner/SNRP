<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'SNRP - Autenticação')
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="snrp-auth-body">

    <div class="snrp-auth-page">

        {{-- =====================================================
             CABEÇALHO DE AUTENTICAÇÃO
             ===================================================== --}}

        <header class="snrp-auth-header-bar">

            <div class="snrp-auth-header-brand">

                <a
                    href="{{ url('/') }}"
                    class="snrp-auth-brand-link"
                >

                    <div class="snrp-auth-brand-icon">

                        <i class="bi bi-buildings"></i>

                    </div>

                    <div>

                        <span class="snrp-auth-brand-name">
                            SNRP
                        </span>

                        <span class="snrp-auth-brand-description">
                            Sistema Nacional de Registo Patrimonial
                        </span>

                    </div>

                </a>

            </div>

        </header>


        {{-- =====================================================
             CONTEÚDO DO LOGIN
             ===================================================== --}}

        <main class="snrp-auth-main">

            <div class="snrp-auth-container">

                {{-- LADO ESQUERDO --}}

                <div class="snrp-auth-brand-panel">

                    <div class="snrp-auth-brand-content">

                        <div class="snrp-auth-logo">

                            <i class="bi bi-buildings"></i>

                        </div>

                        <h1>
                            SNRP
                        </h1>

                        <h2>
                            Sistema Nacional de
                            Registo Patrimonial
                        </h2>

                        <p>
                            Plataforma de registo, organização,
                            consulta e gestão do património.
                        </p>

                        <div class="snrp-auth-line"></div>

                        <small>
                            Gestão patrimonial segura e organizada
                        </small>

                    </div>

                </div>


                {{-- LADO DIREITO --}}

                <div class="snrp-auth-form-area">

                    <div class="snrp-auth-form-wrapper">

                        <div class="snrp-auth-form-header">

                            <div class="snrp-auth-mobile-logo">

                                <i class="bi bi-buildings"></i>

                            </div>

                            <h3>
                                Bem-vindo!
                            </h3>

                            <p>
                                Entre na sua conta para continuar.
                            </p>

                        </div>


                        {{-- FORMULÁRIO BREEZE --}}

                        <div class="snrp-auth-card">

                            {{ $slot }}

                        </div>

                    </div>

                </div>

            </div>

        </main>


        {{-- =====================================================
             FOOTER
             ===================================================== --}}

        @include('partials.snrp-footer')

    </div>

</body>

</html>