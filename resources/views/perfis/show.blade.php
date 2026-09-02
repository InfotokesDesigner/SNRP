@extends('layouts.snrp.app')

@section('title', 'Visualizar Perfil')

@section('content')
<div class="container-fluid py-4">

    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-shield-check me-2"></i>
                {{ $role->nome }}
            </h2>

            <p class="text-muted mb-0">
                Detalhes do perfil e respetivas permissões de acesso.
            </p>
        </div>

        <div class="d-flex gap-2">

            @if(auth()->user()->hasPermission('perfis.editar'))
                <a href="{{ route('perfis.edit', $role) }}"
                   class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i>
                    Editar
                </a>
            @endif

            <a href="{{ route('perfis.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Voltar
            </a>

        </div>
    </div>


    <div class="row g-4">

        {{-- Informações do perfil --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shield-lock text-primary me-2"></i>
                        <strong>Informações do Perfil</strong>
                    </div>
                </div>

                <div class="card-body">

                    {{-- Ícone --}}
                    <div class="text-center mb-4">

                        <div class="rounded-circle bg-primary bg-opacity-10
                                    d-inline-flex align-items-center justify-content-center"
                             style="width:80px;height:80px;">

                            <i class="bi bi-shield-check text-primary fs-1"></i>

                        </div>

                        <h4 class="fw-bold mt-3 mb-1">
                            {{ $role->nome }}
                        </h4>

                        @if($role->ativo)
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Ativo
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Inativo
                            </span>
                        @endif

                    </div>


                    {{-- ID --}}
                    <div class="border-bottom pb-3 mb-3">

                        <small class="text-muted d-block">
                            ID do Perfil
                        </small>

                        <strong>
                            #{{ $role->id }}
                        </strong>

                    </div>


                    {{-- Descrição --}}
                    <div class="border-bottom pb-3 mb-3">

                        <small class="text-muted d-block mb-1">
                            Descrição
                        </small>

                        @if($role->descricao)

                            <span>
                                {{ $role->descricao }}
                            </span>

                        @else

                            <span class="text-muted">
                                Sem descrição definida.
                            </span>

                        @endif

                    </div>


                    {{-- Utilizadores --}}
                    <div>

                        <small class="text-muted d-block">
                            Utilizadores associados
                        </small>

                        <div class="mt-2">

                            <span class="badge bg-info text-dark fs-6">
                                <i class="bi bi-people me-1"></i>
                                {{ $role->users()->count() }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Permissões --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">
                            <i class="bi bi-key-fill text-primary me-2"></i>
                            <strong>Permissões de Acesso</strong>
                        </div>

                        <span class="badge bg-primary">
                            {{ $role->permissions->count() }}
                            {{ $role->permissions->count() === 1 ? 'permissão' : 'permissões' }}
                        </span>

                    </div>

                </div>


                <div class="card-body">

                    @if($role->permissions->isEmpty())

                        <div class="text-center text-muted py-5">

                            <i class="bi bi-key fs-1 d-block mb-3"></i>

                            <h5>Nenhuma permissão atribuída</h5>

                            <p class="mb-0">
                                Este perfil ainda não possui permissões de acesso.
                            </p>

                        </div>

                    @else

                        @php
                            $permissionsByModule = $role->permissions->groupBy('modulo');
                        @endphp


                        <div class="row g-3">

                            @foreach($permissionsByModule as $modulo => $moduloPermissions)

                                <div class="col-12">

                                    <div class="border rounded">

                                        {{-- Módulo --}}
                                        <div class="bg-light px-3 py-2 border-bottom">

                                            <div class="d-flex align-items-center">

                                                <i class="bi bi-folder2-open text-primary me-2"></i>

                                                <span class="fw-semibold text-uppercase">
                                                    {{ str_replace('_', ' ', $modulo) }}
                                                </span>

                                                <span class="badge bg-secondary ms-2">
                                                    {{ $moduloPermissions->count() }}
                                                </span>

                                            </div>

                                        </div>


                                        {{-- Permissões do módulo --}}
                                        <div class="p-3">

                                            <div class="row g-2">

                                                @foreach($moduloPermissions as $permission)

                                                    <div class="col-md-6">

                                                        <div class="border rounded p-3 h-100">

                                                            <div class="d-flex align-items-start">

                                                                <i class="bi bi-check-circle-fill
                                                                          text-success me-2 mt-1">
                                                                </i>

                                                                <div>

                                                                    <div class="fw-semibold">
                                                                        {{ $permission->nome }}
                                                                    </div>

                                                                    @if($permission->descricao)

                                                                        <small class="text-muted d-block mt-1">
                                                                            {{ $permission->descricao }}
                                                                        </small>

                                                                    @endif

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                @endforeach

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
@endsection