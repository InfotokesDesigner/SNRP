<aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">

    <div class="sidebar-brand">

        <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none">

            <span class="brand-text fw-bold">
                SNRP
            </span>

        </a>

    </div>

    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu">

                {{-- Dashboard --}}
                <li class="nav-item">

                    <a href="{{ route('dashboard') }}"
                       class="nav-link">

                        <i class="nav-icon bi bi-speedometer2"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>

                {{-- Cadastros --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon bi bi-folder"></i>

                        <p>
                            Cadastros
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                           <a href="{{ route('instituicoes.index') }}" class="nav-link">

                       <i class="nav-icon bi bi-building"></i>

                     <p>Instituições</p>

                       </a>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-people"></i>

                                <p>Pessoas</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-house"></i>

                                <p>Patrimónios</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Operações --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon bi bi-arrow-left-right"></i>

                        <p>
                            Operações
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-arrow-repeat"></i>

                                <p>Transferências</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-images"></i>

                                <p>Fotografias</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Consultas --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon bi bi-search"></i>

                        <p>
                            Consultas
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-globe"></i>

                                <p>Consulta Pública</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="nav-icon bi bi-person-badge"></i>

                                <p>Área do Cidadão</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Relatórios --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon bi bi-bar-chart"></i>

                        <p>Relatórios</p>

                    </a>

                </li>

                {{-- Configurações --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon bi bi-gear"></i>

                        <p>Configurações</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>