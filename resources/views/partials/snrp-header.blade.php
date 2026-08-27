<nav class="app-header navbar navbar-expand bg-body">

    <div class="container-fluid">

        {{-- BOTÃO SIDEBAR --}}
        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link"
                   data-lte-toggle="sidebar"
                   href="#"
                   role="button"
                   aria-label="Abrir ou fechar menu">

                    <i class="bi bi-list fs-5"></i>

                </a>

            </li>

        </ul>


        {{-- IDENTIFICAÇÃO DO SISTEMA --}}
        <div class="d-none d-md-flex align-items-center">

            <span class="fw-semibold text-primary">
                SNRP
            </span>

            <span class="text-muted ms-2">
                Sistema Nacional de Registo Patrimonial
            </span>

        </div>


        {{-- ÁREA DO UTILIZADOR --}}
        <ul class="navbar-nav ms-auto">

            @auth

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle d-flex align-items-center"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <i class="bi bi-person-circle fs-5 me-2"></i>

                        <span class="d-none d-md-inline">
                            {{ Auth::user()->name }}
                        </span>

                    </a>


                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                        {{-- CABEÇALHO DO PERFIL --}}
                        <li>

                            <div class="dropdown-header">

                                <div class="fw-semibold text-dark">

                                    {{ Auth::user()->name }}

                                </div>

                                <small class="text-muted">

                                    Utilizador do SNRP

                                </small>

                            </div>

                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        {{-- MEU PERFIL --}}
                        <li>

                            <a href="{{ route('profile.edit') }}"
                               class="dropdown-item">

                                <i class="bi bi-person me-2"></i>

                                Meu Perfil

                            </a>

                        </li>


                        {{-- SAIR --}}
                        <li>

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button type="submit"
                                        class="dropdown-item text-danger">

                                    <i class="bi bi-box-arrow-right me-2"></i>

                                    Sair

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            @endauth

        </ul>

    </div>

</nav>