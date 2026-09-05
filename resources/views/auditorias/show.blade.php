@extends('layouts.snrp.app')

@section('title', 'Detalhes da Auditoria')

@section('page-title', 'Detalhes da Auditoria')

@section('content')

@php
$modulos = [
'autenticacao' => 'Autenticação',
'utilizadores' => 'Utilizadores',
'perfis' => 'Perfis e Permissões',
'instituicoes' => 'Instituições',
'pessoas' => 'Pessoas',
'patrimonios' => 'Patrimónios',
'tipos_patrimonio' => 'Tipos de Património',
'transferencias' => 'Transferências',
'fotografias' => 'Fotografias',
'relatorios' => 'Relatórios',
'sistema' => 'Sistema',
];

$acoes = [
    'login' => 'Login',
    'logout' => 'Logout',
    'criar' => 'Criação',
    'editar' => 'Edição',
    'eliminar' => 'Eliminação',
    'visualizar' => 'Visualização',
    'transferir' => 'Transferência',
];

$badgeClass = match($auditoria->acao) {
    'login' => 'bg-success',
    'logout' => 'bg-secondary',
    'criar' => 'bg-primary',
    'editar' => 'bg-warning text-dark',
    'eliminar' => 'bg-danger',
    'visualizar' => 'bg-info text-dark',
    'transferir' => 'bg-primary',
    default => 'bg-dark',
};

$moduloNome = $modulos[$auditoria->modulo] ?? (
    $auditoria->modulo
        ? ucfirst(str_replace('_', ' ', $auditoria->modulo))
        : 'Não definido'
);

$acaoNome = $acoes[$auditoria->acao] ?? ucfirst($auditoria->acao);


@endphp

<div class="row g-4">

{{-- INFORMAÇÃO DA OPERAÇÃO --}}
<div class="col-lg-8">

    <div class="card shadow-sm">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">

                <h3 class="card-title mb-0">
                    <i class="bi bi-shield-check me-2"></i>
                    Registo de Auditoria #{{ $auditoria->id }}
                </h3>

                <a href="{{ route('auditorias.index') }}"
                   class="btn btn-outline-secondary btn-sm">

                    <i class="bi bi-arrow-left me-1"></i>
                    Voltar

                </a>

            </div>
        </div>

        <div class="card-body">

            {{-- INFORMAÇÃO DA OPERAÇÃO --}}
            <div class="mb-4">

                <h5 class="border-bottom pb-2">
                    <i class="bi bi-activity me-2"></i>
                    Informação da Operação
                </h5>

            </div>

            <div class="row g-4">

                {{-- AÇÃO --}}
                <div class="col-md-4">

                    <label class="form-label text-muted mb-1">
                        Ação
                    </label>

                    <div>
                        <span class="badge {{ $badgeClass }} fs-6">
                            {{ $acaoNome }}
                        </span>
                    </div>

                </div>

                {{-- MÓDULO --}}
                <div class="col-md-4">

                    <label class="form-label text-muted mb-1">
                        Módulo
                    </label>

                    <div class="fw-semibold">
                        {{ $moduloNome }}
                    </div>

                </div>

                {{-- DATA --}}
                <div class="col-md-4">

                    <label class="form-label text-muted mb-1">
                        Data e Hora
                    </label>

                    <div class="fw-semibold">
                        {{ $auditoria->created_at?->format('d/m/Y H:i:s') ?? 'Não disponível' }}
                    </div>

                </div>

                {{-- DESCRIÇÃO --}}
                <div class="col-12">

                    <label class="form-label text-muted mb-1">
                        Descrição
                    </label>

                    <div class="alert alert-light border mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        {{ $auditoria->descricao ?? 'Sem descrição.' }}

                    </div>

                </div>

            </div>


            {{-- REGISTO AFETADO --}}
            @if($auditoria->auditable_type || $auditoria->auditable_id)

                <div class="mt-5 mb-4">

                    <h5 class="border-bottom pb-2">
                        <i class="bi bi-database me-2"></i>
                        Registo Afetado
                    </h5>

                </div>

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Tipo de Registo
                        </label>

                        <div class="fw-semibold">

                            @if($auditoria->auditable_type)
                                {{ class_basename($auditoria->auditable_type) }}
                            @else
                                Não definido
                            @endif

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            ID do Registo
                        </label>

                        <div class="fw-semibold">
                            {{ $auditoria->auditable_id ?? '—' }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- DADOS ANTERIORES --}}
            @if(!empty($auditoria->dados_anteriores))

                <div class="mt-5 mb-4">

                    <h5 class="border-bottom pb-2">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Dados Anteriores
                    </h5>

                </div>

                <div class="bg-light border rounded p-3">

                    <pre class="mb-0 small overflow-auto">{{ json_encode($auditoria->dados_anteriores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>

                </div>

            @endif


            {{-- DADOS NOVOS --}}
            @if(!empty($auditoria->dados_novos))

                <div class="mt-5 mb-4">

                    <h5 class="border-bottom pb-2">
                        <i class="bi bi-arrow-right-circle me-2"></i>
                        Dados Novos
                    </h5>

                </div>

                <div class="bg-light border rounded p-3">

                    <pre class="mb-0 small overflow-auto">{{ json_encode($auditoria->dados_novos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- INFORMAÇÃO TÉCNICA --}}

<div class="col-lg-4">


<div class="card shadow-sm">

    <div class="card-header">

        <h3 class="card-title mb-0">
            <i class="bi bi-pc-display me-2"></i>
            Informação Técnica
        </h3>

    </div>

    <div class="card-body">

        {{-- UTILIZADOR --}}
        <div class="mb-4">

            <label class="form-label text-muted">
                Utilizador
            </label>

            @if($auditoria->user)

                <div class="d-flex align-items-center">

                    <i class="bi bi-person-circle fs-2 me-2 text-primary"></i>

                    <div>

                        <div class="fw-semibold">
                            {{ $auditoria->user->name }}
                        </div>

                        <small class="text-muted">
                            {{ $auditoria->user->email }}
                        </small>

                    </div>

                </div>

            @else

                <span class="text-muted">
                    Sistema / Não identificado
                </span>

            @endif

        </div>


        {{-- ENDEREÇO IP --}}
        <div class="mb-4">

            <label class="form-label text-muted">
                Endereço IP
            </label>

            <div class="fw-semibold">

                <i class="bi bi-globe2 me-1"></i>

                {{ trim($auditoria->ip_address ?? 'Não disponível') }}

            </div>

        </div>


        {{-- NAVEGADOR --}}
        <div>

            <label class="form-label text-muted">
                Navegador / User Agent
            </label>

            <div class="small text-break bg-light border rounded p-2">

                {{ $auditoria->user_agent ?? 'Não disponível' }}

            </div>

        </div>

    </div>

</div>


{{-- IDENTIFICAÇÃO --}}

<div class="card shadow-sm mt-4">

    <div class="card-header">

        <h3 class="card-title mb-0">

            <i class="bi bi-hash me-2"></i>
            Identificação

        </h3>

    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="form-label text-muted">
                ID da Auditoria
            </label>

            <div class="fw-bold fs-5">
                #{{ $auditoria->id }}
            </div>

        </div>

        <div>

            <label class="form-label text-muted">
                Registado em
            </label>

            <div>
                {{ $auditoria->created_at?->format('d/m/Y H:i:s') }}
            </div>

        </div>

    </div>

</div>


</div>

</div>
@endsection
