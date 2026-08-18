<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end">

                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="bi bi-person me-2"></i>
                        Meu Perfil
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Sair
                        </button>
                    </form>

                </div>
            </li>

        </ul>

    </div>
</nav>