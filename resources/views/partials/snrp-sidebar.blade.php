<<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- LOGOTIPO --}}
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            <strong>SNRP</strong>
        </span>
    </a>

    {{-- MENU --}}
    <div class="sidebar">

        {{-- UTILIZADOR --}}
        @auth
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="{{ route('profile.edit') }}" class="d-block">
                        <i class="fas fa-user-circle mr-2"></i>
                        {{ Auth::user()->name }}
                    </a>
                </div>
            </div>
        @endauth

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- CADASTROS --}}
                <li class="nav-header">CADASTROS</li>

                {{-- PESSOAS --}}
                <li class="nav-item">
                    <a href="{{ route('pessoas.index') }}"
                       class="nav-link {{ request()->routeIs('pessoas.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pessoas</p>
                    </a>
                </li>

                {{-- PATRIMÓNIOS --}}
                <li class="nav-item">
                    <a href="{{ route('patrimonios.index') }}"
                       class="nav-link {{ request()->routeIs('patrimonios.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Patrimónios</p>
                    </a>
                </li>

                {{-- TIPOS DE PATRIMÓNIO --}}
                <li class="nav-item">
                    <a href="{{ route('tipos-patrimonio.index') }}"
                       class="nav-link {{ request()->routeIs('tipos-patrimonio.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Tipos de Património</p>
                    </a>
                </li>

                {{-- INSTITUIÇÕES --}}
                <li class="nav-item">
                    <a href="{{ route('instituicoes.index') }}"
                       class="nav-link {{ request()->routeIs('instituicoes.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Instituições</p>
                    </a>
                </li>

                {{-- GESTÃO PATRIMONIAL --}}
                <li class="nav-header">GESTÃO PATRIMONIAL</li>

                {{-- TRANSFERÊNCIAS --}}
                <li class="nav-item">
                    <a href="{{ route('transferencias-patrimoniais.index') }}"
                       class="nav-link {{ request()->routeIs('transferencias-patrimoniais.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transferências</p>
                    </a>
                </li>

                {{-- FOTOGRAFIAS --}}
                <li class="nav-item">
                    <a href="{{ route('patrimonios.index') }}"
                       class="nav-link">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Fotografias</p>
                    </a>
                </li>

                {{-- CONSULTAS --}}
                <li class="nav-header">CONSULTAS</li>

                {{-- CONSULTA PÚBLICA --}}
                <li class="nav-item">
                    <a href="{{ url('/consulta-publica') }}"
                       class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Consulta Pública</p>
                    </a>
                </li>

                {{-- SISTEMA --}}
                <li class="nav-header">SISTEMA</li>

                {{-- PERFIL --}}
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Meu Perfil</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>