@extends('layouts.snrp.app')

@section('title', 'Detalhes do Utilizador')
@section('page-title', 'Detalhes do Utilizador')

@section('content')

<div class="container-fluid">

{{-- CABEÇALHO DA PÁGINA --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="h3 mb-1">
            <i class="bi bi-person-vcard-fill text-primary me-2"></i>
            Detalhes do Utilizador
        </h1>

        <p class="text-muted mb-0">
            Visualização das informações e do perfil de acesso do utilizador.
        </p>
    </div>

    <div class="d-flex gap-2">

        <a href="{{ route('utilizadores.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Voltar
        </a>

        @if(auth()->user()->hasPermission('utilizadores.editar'))
            <a href="{{ route('utilizadores.edit', $utilizador) }}"
               class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i>
                Editar
            </a>
        @endif

    </div>

</div>


{{-- CARTÃO PRINCIPAL --}}
<div class="row g-4">

    {{-- INFORMAÇÕES DO UTILIZADOR --}}
    <div class="col-lg-8">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-person-fill me-2"></i>
                    Informações do Utilizador
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- NOME --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Nome completo
                        </label>

                        <div class="fw-semibold fs-5">
                            {{ $utilizador->name }}
                        </div>

                    </div>


                    {{-- E-MAIL --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            E-mail
                        </label>

                        <div class="fw-semibold">
                            <i class="bi bi-envelope me-1 text-primary"></i>
                            {{ $utilizador->email }}
                        </div>

                    </div>


                    {{-- PERFIL --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Perfil de acesso
                        </label>

                        <div>

                            @if($utilizador->role)

                                <span class="badge bg-info text-dark fs-6">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ $utilizador->role->nome }}
                                </span>

                            @else

                                <span class="text-muted">
                                    Não definido
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- INSTITUIÇÃO --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Instituição
                        </label>

                        <div class="fw-semibold">

                            @if($utilizador->instituicao)

                                <i class="bi bi-building me-1 text-primary"></i>
                                {{ $utilizador->instituicao->nome }}

                            @else

                                <span class="text-muted">
                                    Não definida
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ESTADO --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Estado da conta
                        </label>

                        <div>

                            @if($utilizador->ativo)

                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Ativo
                                </span>

                            @else

                                <span class="badge bg-danger fs-6">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Inativo
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ÚLTIMO ACESSO --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Último acesso
                        </label>

                        <div class="fw-semibold">

                            @if($utilizador->ultimo_acesso)

                                <i class="bi bi-clock-history me-1 text-primary"></i>
                                {{ $utilizador->ultimo_acesso->format('d/m/Y H:i') }}

                            @else

                                <span class="text-muted">
                                    Ainda não registado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DATA DE CRIAÇÃO --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Registado em
                        </label>

                        <div class="fw-semibold">

                            @if($utilizador->created_at)

                                <i class="bi bi-calendar-plus me-1 text-primary"></i>
                                {{ $utilizador->created_at->format('d/m/Y H:i') }}

                            @else

                                <span class="text-muted">
                                    Não disponível
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ÚLTIMA ATUALIZAÇÃO --}}
                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Última atualização
                        </label>

                        <div class="fw-semibold">

                            @if($utilizador->updated_at)

                                <i class="bi bi-calendar-check me-1 text-primary"></i>
                                {{ $utilizador->updated_at->format('d/m/Y H:i') }}

                            @else

                                <span class="text-muted">
                                    Não disponível
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- CARTÃO DO PERFIL --}}
    <div class="col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-shield-lock-fill me-2"></i>
                    Perfil de Acesso
                </h5>

            </div>

            <div class="card-body text-center">

                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width: 90px; height: 90px; font-size: 2.5rem;">

                    <i class="bi bi-person-fill"></i>

                </div>

                <h4 class="mb-1">
                    {{ $utilizador->name }}
                </h4>

                @if($utilizador->role)

                    <span class="badge bg-info text-dark mb-3">
                        {{ $utilizador->role->nome }}
                    </span>

                    @if($utilizador->role->descricao)

                        <p class="text-muted small mt-2">
                            {{ $utilizador->role->descricao }}
                        </p>

                    @endif

                @else

                    <p class="text-muted">
                        Nenhum perfil associado.
                    </p>

                @endif

                <hr>

                <div class="text-start">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Estado
                        </span>

                        @if($utilizador->ativo)

                            <span class="text-success fw-semibold">
                                Ativo
                            </span>

                        @else

                            <span class="text-danger fw-semibold">
                                Inativo
                            </span>

                        @endif

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            ID
                        </span>

                        <span class="fw-semibold">
                            #{{ $utilizador->id }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
