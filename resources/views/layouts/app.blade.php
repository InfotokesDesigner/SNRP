<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Autenticação - SNRP')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="snrp-auth-body">

    <div class="snrp-auth-container">

        {{-- =====================================================
             LADO ESQUERDO - IDENTIDADE DO SNRP
             ===================================================== --}}

        <div class="snrp-auth-brand">

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
                    consulta e proteção dos bens patrimoniais.
                </p>

                <div class="snrp-auth-line"></div>

                <small>
                    Gestão patrimonial segura e organizada
                </small>

            </div>

        </div>


        {{-- =====================================================
             LADO DIREITO - FORMULÁRIO
             ===================================================== --}}

        <div class="snrp-auth-form-area">

            <div class="snrp-auth-form-wrapper">

                {{-- LOGO / CABEÇALHO --}}

                <div class="snrp-auth-header">

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


                {{-- RODAPÉ --}}

                <div class="snrp-auth-footer">

                    <span>
                        SNRP &copy; {{ date('Y') }}
                    </span>

                    <span class="snrp-auth-footer-separator">
                        |
                    </span>

                    <span>
                        Todos os direitos reservados.
                    </span>

                </div>

            </div>

        </div>

    </div>

</body>

</html>