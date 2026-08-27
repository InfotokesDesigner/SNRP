<aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">

    {{-- LOGOTIPO --}}
    <div class="sidebar-brand">

        <a href="{{ route('dashboard') }}" class="brand-link">

            <span class="brand-text fw-bold">
                SNRP
            </span>

        </a>

    </div>


    {{-- UTILIZADOR --}}
    @auth
        <div class="sidebar-user px-3 py-3 border-bottom border-secondary">

            <a href="{{ route('profile.edit') }}"
               class="d-flex align-items-center text-decoration-none text-white">

                <i class="bi bi-person-circle fs-3 me-2"></i>

                <div class="lh-sm">

                    <div class="fw-semibold">
                        {{ Auth::user()->name }}
                    </div>

                    <small class="text-white-50">
                        Utilizador
                    </small>

                </div>

            </a>

        </div>
    @endauth


    {{-- MENU --}}
    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">


                {{-- DASHBOARD --}}
                <li class="nav-item">

                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-speedometer2"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                {{-- CADASTROS --}}
                <li class="nav-header">
                    CADASTROS
                </li>


                {{-- PESSOAS --}}
                <li class="nav-item">

                    <a href="{{ route('pessoas.index') }}"
                       class="nav-link {{ request()->routeIs('pessoas.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-people"></i>

                        <p>
                            Pessoas
                        </p>

                    </a>

                </li>


                {{-- PATRIMÓNIOS --}}
                <li class="nav-item">

                    <a href="{{ route('patrimonios.index') }}"
                       class="nav-link {{ request()->routeIs('patrimonios.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-buildings"></i>

                        <p>
                            Patrimónios
                        </p>

                    </a>

                </li>


                {{-- TIPOS DE PATRIMÓNIO --}}
                <li class="nav-item">

                    <a href="{{ route('tipos-patrimonio.index') }}"
                       class="nav-link {{ request()->routeIs('tipos-patrimonio.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-tags"></i>

                        <p>
                            Tipos de Património
                        </p>

                    </a>

                </li>


                {{-- INSTITUIÇÕES --}}
                <li class="nav-item">

                    <a href="{{ route('instituicoes.index') }}"
                       class="nav-link {{ request()->routeIs('instituicoes.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-bank"></i>

                        <p>
                            Instituições
                        </p>

                    </a>

                </li>


                {{-- OPERAÇÕES --}}
                <li class="nav-header">
                    OPERAÇÕES
                </li>


                {{-- TRANSFERÊNCIAS --}}
                <li class="nav-item">

                    <a href="{{ route('transferencias-patrimoniais.index') }}"
                       class="nav-link {{ request()->routeIs('transferencias-patrimoniais.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-arrow-left-right"></i>

                        <p>
                            Transferências
                        </p>

                    </a>

                </li>


                {{-- CONSULTAS --}}
                <li class="nav-header">
                    CONSULTAS
                </li>


                {{-- CONSULTA PÚBLICA --}}
                <li class="nav-item">

                    <a href="{{ url('/consulta-publica') }}"
                       class="nav-link">

                        <i class="nav-icon bi bi-search"></i>

                        <p>
                            Consulta Pública
                        </p>

                    </a>

                </li>


                {{-- RELATÓRIOS --}}
                <li class="nav-header">
                    RELATÓRIOS
                </li>


                {{-- AUDITORIA --}}
                {{-- Rota será implementada na próxima etapa --}}
                <li class="nav-item">

                    <a href="#"
                       class="nav-link disabled">

                        <i class="nav-icon bi bi-shield-check"></i>

                        <p>
                            Auditoria
                        </p>

                    </a>

                </li>


                {{-- ADMINISTRAÇÃO --}}
                <li class="nav-header">
                    ADMINISTRAÇÃO
                </li>


                {{-- UTILIZADORES --}}
                {{-- Rota será implementada na próxima etapa --}}
                <li class="nav-item">

                    <a href="#"
                       class="nav-link disabled">

                        <i class="nav-icon bi bi-person-gear"></i>

                        <p>
                            Utilizadores
                        </p>

                    </a>

                </li>


                {{-- PERFIS E PERMISSÕES --}}
                {{-- Rota será implementada na próxima etapa --}}
                <li class="nav-item">

                    <a href="#"
                       class="nav-link disabled">

                        <i class="nav-icon bi bi-shield-lock"></i>

                        <p>
                            Perfis e Permissões
                        </p>

                    </a>

                </li>


                {{-- SISTEMA --}}
                <li class="nav-header">
                    SISTEMA
                </li>


                {{-- MEU PERFIL --}}
                <li class="nav-item">

                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-person-circle"></i>

                        <p>
                            Meu Perfil
                        </p>

                    </a>

                </li>


            </ul>

        </nav>

    </div>

</aside>