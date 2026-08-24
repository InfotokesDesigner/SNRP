<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Consulta Pública - SNRP')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            background: #f4f6f9;
        }

        .public-header {
            background: #0b3d91;
            color: white;
        }

        .public-logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .public-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .public-footer {
            background: #0b3d91;
            color: rgba(255,255,255,.85);
        }

        .patrimonio-photo {
            width: 100%;
            height: 380px;
            object-fit: cover;
        }
    </style>

</head>

<body>

    {{-- Cabeçalho público --}}
    <header class="public-header shadow-sm">

        <div class="container py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div class="public-logo">
                    <i class="bi bi-building me-2"></i>
                    SNRP
                </div>

                <div class="small">
                    Sistema de Registo Patrimonial
                </div>

            </div>

        </div>

    </header>


    {{-- Conteúdo --}}
    <main class="py-4">

        <div class="container public-container">

            @yield('content')

        </div>

    </main>


    {{-- Rodapé --}}
    <footer class="public-footer mt-5">

        <div class="container py-4 text-center">

            <div class="fw-semibold">
                Sistema de Registo Patrimonial — SNRP
            </div>

            <small>
                Consulta pública de património
            </small>

            <div class="mt-2 small">
                © {{ date('Y') }} — Todos os direitos reservados.
            </div>

        </div>

    </footer>

    @stack('scripts')

</body>

</html>