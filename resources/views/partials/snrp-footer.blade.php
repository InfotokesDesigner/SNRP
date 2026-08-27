<footer class="app-footer snrp-footer">

    {{-- COPYRIGHT --}}
    <div class="snrp-footer-left">

        <span class="snrp-footer-copyright">
            <strong>SNRP</strong>
            &copy; {{ date('Y') }}
        </span>

        <span class="snrp-footer-separator">|</span>

        <span>
            Todos os direitos reservados.
        </span>

    </div>


    {{-- DESENVOLVEDOR --}}
    <div class="snrp-footer-developer">

        <span class="snrp-footer-separator d-none d-md-inline">
            |
        </span>

        <a
            href="{{ config('app.infotokes_url') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="snrp-footer-brand"
        >

            <img
                src="{{ asset('images/infotokes-logo.png') }}"
                alt="Infotokes Designer"
                class="snrp-footer-logo"
            >

            <span>
                Designed by
                <strong>Infotokes Designer</strong>
            </span>

        </a>

        <span class="snrp-footer-separator d-none d-md-inline">
            |
        </span>

        <a
            href="{{ config('app.infotokes_url') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="snrp-footer-link"
        >
            www.infotokes.it.ao
        </a>

    </div>


    {{-- IDENTIFICAÇÃO DO SISTEMA --}}
    <div class="snrp-footer-system">

        Sistema Nacional de Registo Patrimonial

    </div>

</footer>