@extends('layouts.snrp.app')

@section('title', 'Dashboard - SNRP')

@section('page-title', 'Painel Operacional')

@section('content')

<div class="snrp-dashboard">

    {{-- =====================================================
         CABEÇALHO
         ===================================================== --}}

    <div class="snrp-dashboard-header">

        <div class="snrp-dashboard-title">

            <div class="snrp-dashboard-title-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <div>
                <h2>Painel Operacional</h2>

                <p>
                    Sistema Nacional de Registo Patrimonial
                </p>
            </div>

        </div>

        <div class="snrp-dashboard-user">

            <div class="snrp-online-indicator"></div>

            <div>
                <strong>{{ Auth::user()->name }}</strong>

                <small>
                    Sessão ativa
                </small>
            </div>

            <i class="bi bi-person-circle"></i>

        </div>

    </div>


    {{-- =====================================================
         INDICADORES
         ===================================================== --}}

    <div class="snrp-stats-grid">


        {{-- PATRIMÓNIOS --}}
        <div class="snrp-stat-card">

            <div class="snrp-stat-icon blue">
                <i class="bi bi-buildings"></i>
            </div>

            <div class="snrp-stat-content">

                <span>Patrimónios Registados</span>

                <strong>{{ $totalPatrimonios }}</strong>

                <small>
                    Bens patrimoniais no sistema
                </small>

            </div>

            <a href="{{ route('patrimonios.index') }}"
               class="snrp-stat-link">

                Ver <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        {{-- PESSOAS --}}
        <div class="snrp-stat-card">

            <div class="snrp-stat-icon cyan">
                <i class="bi bi-people"></i>
            </div>

            <div class="snrp-stat-content">

                <span>Pessoas Registadas</span>

                <strong>{{ $totalPessoas }}</strong>

                <small>
                    Proprietários e cidadãos
                </small>

            </div>

            <a href="{{ route('pessoas.index') }}"
               class="snrp-stat-link">

                Ver <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        {{-- INSTITUIÇÕES --}}
        <div class="snrp-stat-card">

            <div class="snrp-stat-icon green">
                <i class="bi bi-bank"></i>
            </div>

            <div class="snrp-stat-content">

                <span>Instituições</span>

                <strong>{{ $totalInstituicoes }}</strong>

                <small>
                    Entidades registadas
                </small>

            </div>

            <a href="{{ route('instituicoes.index') }}"
               class="snrp-stat-link">

                Ver <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        {{-- TRANSFERÊNCIAS --}}
        <div class="snrp-stat-card">

            <div class="snrp-stat-icon orange">
                <i class="bi bi-arrow-left-right"></i>
            </div>

            <div class="snrp-stat-content">

                <span>Transferências</span>

                <strong>{{ $totalTransferencias }}</strong>

                <small>
                    Operações patrimoniais
                </small>

            </div>

            <a href="{{ route('transferencias-patrimoniais.index') }}"
               class="snrp-stat-link">

                Ver <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>


    {{-- =====================================================
         ÁREA PRINCIPAL
         ===================================================== --}}

    <div class="snrp-dashboard-grid">


        {{-- =================================================
             RESUMO
             ================================================= --}}

        <div class="snrp-panel snrp-panel-main">

            <div class="snrp-panel-header">

                <div>
                    <span class="snrp-panel-label">
                        VISÃO GERAL
                    </span>

                    <h3>
                        Resumo Patrimonial
                    </h3>

                    <p>
                        Informações gerais do registo patrimonial.
                    </p>
                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>

            </div>


            <div class="snrp-overview-grid">

                <div class="snrp-overview-item">

                    <div class="snrp-overview-icon">
                        <i class="bi bi-buildings"></i>
                    </div>

                    <div>
                        <strong>{{ $totalPatrimonios }}</strong>

                        <span>Patrimónios</span>
                    </div>

                </div>


                <div class="snrp-overview-item">

                    <div class="snrp-overview-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div>
                        <strong>{{ $totalPessoas }}</strong>

                        <span>Pessoas</span>
                    </div>

                </div>


                <div class="snrp-overview-item">

                    <div class="snrp-overview-icon">
                        <i class="bi bi-bank"></i>
                    </div>

                    <div>
                        <strong>{{ $totalInstituicoes }}</strong>

                        <span>Instituições</span>
                    </div>

                </div>


                <div class="snrp-overview-item">

                    <div class="snrp-overview-icon">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>

                    <div>
                        <strong>{{ $totalTransferencias }}</strong>

                        <span>Transferências</span>
                    </div>

                </div>

            </div>


            {{-- ESTADO DO SISTEMA --}}

            <div class="snrp-system-status">

                <div class="snrp-status-title">

                    <i class="bi bi-activity"></i>

                    <span>
                        Estado do sistema
                    </span>

                </div>

                <div class="snrp-status-line">

                    <span>
                        Sistema operacional
                    </span>

                    <strong class="status-online">
                        <i class="bi bi-circle-fill"></i>
                        ONLINE
                    </strong>

                </div>

            </div>

        </div>


        {{-- =================================================
             CONSULTA PÚBLICA
             ================================================= --}}

        <div class="snrp-panel snrp-public-panel">

            <div class="snrp-panel-header">

                <div>
                    <span class="snrp-panel-label">
                        CONSULTA
                    </span>

                    <h3>
                        Consulta Pública
                    </h3>
                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-search"></i>
                </div>

            </div>


            <p class="snrp-public-description">
                Consulte um património através do seu código único.
            </p>


            <form id="snrpConsultaForm">

                <label for="codigoPatrimonio">
                    Código do Património
                </label>

                <div class="snrp-search-box">

                    <i class="bi bi-qr-code-scan"></i>

                    <input
                        type="text"
                        id="codigoPatrimonio"
                        placeholder="Ex.: SNRP-CAS-000001"
                        autocomplete="off"
                    >

                </div>

                <button type="submit"
                        class="snrp-primary-button">

                    <i class="bi bi-search"></i>

                    Consultar Património

                </button>

            </form>


            <div class="snrp-public-security">

                <i class="bi bi-shield-lock"></i>

                <span>
                    Consulta pública segura
                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
         SEGUNDA ÁREA
         ===================================================== --}}

    <div class="snrp-dashboard-grid-3">


        {{-- FLUXO --}}
        <div class="snrp-panel">

            <div class="snrp-panel-header">

                <div>

                    <span class="snrp-panel-label">
                        PROCESSO
                    </span>

                    <h3>
                        Fluxo do Registo
                    </h3>

                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-diagram-3"></i>
                </div>

            </div>


            <div class="snrp-process">

                <div class="snrp-process-item">

                    <div class="snrp-process-number">
                        01
                    </div>

                    <i class="bi bi-person-plus"></i>

                    <span>
                        Registar Pessoa
                    </span>

                </div>


                <div class="snrp-process-arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>


                <div class="snrp-process-item">

                    <div class="snrp-process-number">
                        02
                    </div>

                    <i class="bi bi-building-add"></i>

                    <span>
                        Registar Património
                    </span>

                </div>


                <div class="snrp-process-arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>


                <div class="snrp-process-item">

                    <div class="snrp-process-number">
                        03
                    </div>

                    <i class="bi bi-qr-code"></i>

                    <span>
                        Identificação
                    </span>

                </div>

            </div>

        </div>


        {{-- ACÇÕES RÁPIDAS --}}
        <div class="snrp-panel">

            <div class="snrp-panel-header">

                <div>

                    <span class="snrp-panel-label">
                        ACESSO RÁPIDO
                    </span>

                    <h3>
                        Operações
                    </h3>

                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>

            </div>


            <div class="snrp-actions-grid">

                <a href="{{ route('patrimonios.create') }}"
                   class="snrp-action">

                    <i class="bi bi-plus-circle"></i>

                    <span>
                        Novo Património
                    </span>

                </a>


                <a href="{{ route('pessoas.create') }}"
                   class="snrp-action">

                    <i class="bi bi-person-plus"></i>

                    <span>
                        Nova Pessoa
                    </span>

                </a>


                <a href="{{ route('instituicoes.create') }}"
                   class="snrp-action">

                    <i class="bi bi-bank"></i>

                    <span>
                        Nova Instituição
                    </span>

                </a>


                <a href="{{ route('transferencias-patrimoniais.create') }}"
                   class="snrp-action">

                    <i class="bi bi-arrow-left-right"></i>

                    <span>
                        Transferir
                    </span>

                </a>

            </div>

        </div>


        {{-- UTILIZADORES --}}
        <div class="snrp-panel">

            <div class="snrp-panel-header">

                <div>

                    <span class="snrp-panel-label">
                        ADMINISTRAÇÃO
                    </span>

                    <h3>
                        Utilizadores
                    </h3>

                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

            </div>


            <div class="snrp-user-total">

                <div class="snrp-user-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>

                    <strong>
                        {{ $totalUtilizadores }}
                    </strong>

                    <span>
                        Utilizadores registados
                    </span>

                </div>

            </div>


            <div class="snrp-user-info">

                <i class="bi bi-shield-check"></i>

                <span>
                    Acesso protegido por autenticação
                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
         RECURSOS DO SISTEMA
         ===================================================== --}}

    <div class="snrp-panel snrp-resources-panel">

        <div class="snrp-panel-header">

            <div>

                <span class="snrp-panel-label">
                    SNRP
                </span>

                <h3>
                    Recursos do Sistema
                </h3>

            </div>

        </div>


        <div class="snrp-resources-grid">

            <div class="snrp-resource">

                <i class="bi bi-qr-code"></i>

                <div>
                    <strong>QR Code</strong>

                    <span>
                        Identificação rápida dos patrimónios
                    </span>
                </div>

            </div>


            <div class="snrp-resource">

                <i class="bi bi-camera"></i>

                <div>
                    <strong>Fotografias</strong>

                    <span>
                        Registo visual dos bens
                    </span>
                </div>

            </div>


            <div class="snrp-resource">

                <i class="bi bi-arrow-left-right"></i>

                <div>
                    <strong>Transferências</strong>

                    <span>
                        Histórico das alterações patrimoniais
                    </span>
                </div>

            </div>


            <div class="snrp-resource">

                <i class="bi bi-shield-check"></i>

                <div>
                    <strong>Segurança</strong>

                    <span>
                        Dados protegidos e controlados
                    </span>
                </div>

            </div>


            <div class="snrp-resource">

                <i class="bi bi-search"></i>

                <div>
                    <strong>Consulta Pública</strong>

                    <span>
                        Verificação através do código
                    </span>
                </div>

            </div>

        </div>

    </div>


</div>


{{-- =====================================================
     CONSULTA PÚBLICA - JAVASCRIPT
     ===================================================== --}}

<script>

document.getElementById('snrpConsultaForm').addEventListener('submit', function (event) {

    event.preventDefault();

    const codigo = document
        .getElementById('codigoPatrimonio')
        .value
        .trim();

    if (!codigo) {
        return;
    }

    window.location.href =
        "{{ url('/consulta-patrimonio') }}/" +
        encodeURIComponent(codigo);

});

</script>

@endsection