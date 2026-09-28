@extends('layouts.snrp.app')

@section('title', 'Dashboard - SNRP')

@section('page-title', 'Dashboard')

@section('content')

<div class="snrp-dashboard">

    {{-- CABEÇALHO DO DASHBOARD --}}
    <div class="snrp-dashboard-header">
        <div>
            <div class="snrp-dashboard-breadcrumb">
                <i class="bi bi-house-door"></i>
                <span>Início</span>
                <i class="bi bi-chevron-right"></i>
                <span>Dashboard</span>
            </div>

            <h2>Painel de Controlo</h2>

            <p>
                Visão geral do Sistema Nacional de Registo Patrimonial
            </p>
        </div>

        <div class="snrp-dashboard-user">
            <div class="snrp-online-indicator"></div>

            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <small>Sessão ativa</small>
            </div>

            <i class="bi bi-person-circle"></i>
        </div>
    </div>


    {{-- INDICADORES PRINCIPAIS --}}
    <div class="snrp-stats-grid">

        <div class="snrp-stat-card">
            <div class="snrp-stat-top">
                <div class="snrp-stat-icon blue">
                    <i class="bi bi-buildings"></i>
                </div>

                <span class="snrp-stat-badge">
                    Registos
                </span>
            </div>

            <div class="snrp-stat-content">
                <span>Patrimónios</span>
                <strong>{{ $totalPatrimonios }}</strong>
                <small>Total de bens registados</small>
            </div>

            <a href="{{ route('patrimonios.index') }}" class="snrp-stat-link">
                Ver patrimónios
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>


        <div class="snrp-stat-card">
            <div class="snrp-stat-top">
                <div class="snrp-stat-icon cyan">
                    <i class="bi bi-people"></i>
                </div>

                <span class="snrp-stat-badge">
                    Registos
                </span>
            </div>

            <div class="snrp-stat-content">
                <span>Pessoas</span>
                <strong>{{ $totalPessoas }}</strong>
                <small>Proprietários e cidadãos</small>
            </div>

            <a href="{{ route('pessoas.index') }}" class="snrp-stat-link">
                Ver pessoas
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>


        <div class="snrp-stat-card">
            <div class="snrp-stat-top">
                <div class="snrp-stat-icon green">
                    <i class="bi bi-bank"></i>
                </div>

                <span class="snrp-stat-badge">
                    Entidades
                </span>
            </div>

            <div class="snrp-stat-content">
                <span>Instituições</span>
                <strong>{{ $totalInstituicoes }}</strong>
                <small>Entidades registadas</small>
            </div>

            <a href="{{ route('instituicoes.index') }}" class="snrp-stat-link">
                Ver instituições
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>


        <div class="snrp-stat-card">
            <div class="snrp-stat-top">
                <div class="snrp-stat-icon orange">
                    <i class="bi bi-arrow-left-right"></i>
                </div>

                <span class="snrp-stat-badge">
                    Operações
                </span>
            </div>

            <div class="snrp-stat-content">
                <span>Transferências</span>
                <strong>{{ $totalTransferencias }}</strong>
                <small>Movimentos patrimoniais</small>
            </div>

            <a href="{{ route('transferencias-patrimoniais.index') }}" class="snrp-stat-link">
                Ver transferências
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>


    {{-- ÁREA PRINCIPAL --}}
    <div class="snrp-dashboard-main-grid">

        {{-- RESUMO --}}
        <div class="snrp-panel snrp-main-overview">

            <div class="snrp-panel-header">
                <div>
                    <span class="snrp-panel-label">VISÃO GERAL</span>
                    <h3>Resumo do Sistema</h3>
                    <p>Estado atual dos principais registos do SNRP.</p>
                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </div>
            </div>


            <div class="snrp-overview-list">

                <div class="snrp-overview-row">
                    <div class="snrp-overview-row-icon blue">
                        <i class="bi bi-buildings"></i>
                    </div>

                    <div class="snrp-overview-row-info">
                        <strong>Patrimónios</strong>
                        <span>Bens patrimoniais cadastrados</span>
                    </div>

                    <strong class="snrp-overview-value">
                        {{ $totalPatrimonios }}
                    </strong>
                </div>


                <div class="snrp-overview-row">
                    <div class="snrp-overview-row-icon cyan">
                        <i class="bi bi-people"></i>
                    </div>

                    <div class="snrp-overview-row-info">
                        <strong>Pessoas</strong>
                        <span>Pessoas associadas ao sistema</span>
                    </div>

                    <strong class="snrp-overview-value">
                        {{ $totalPessoas }}
                    </strong>
                </div>


                <div class="snrp-overview-row">
                    <div class="snrp-overview-row-icon green">
                        <i class="bi bi-bank"></i>
                    </div>

                    <div class="snrp-overview-row-info">
                        <strong>Instituições</strong>
                        <span>Instituições participantes</span>
                    </div>

                    <strong class="snrp-overview-value">
                        {{ $totalInstituicoes }}
                    </strong>
                </div>


                <div class="snrp-overview-row">
                    <div class="snrp-overview-row-icon orange">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>

                    <div class="snrp-overview-row-info">
                        <strong>Transferências</strong>
                        <span>Movimentos patrimoniais</span>
                    </div>

                    <strong class="snrp-overview-value">
                        {{ $totalTransferencias }}
                    </strong>
                </div>

            </div>

        </div>


        {{-- CONSULTA PÚBLICA --}}
        <div class="snrp-panel snrp-consulta-panel">

            <div class="snrp-panel-header">
                <div>
                    <span class="snrp-panel-label">ÁREA DO CIDADÃO</span>

                    <h3>Consulta Patrimonial</h3>
                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-search"></i>
                </div>
            </div>


            <div class="snrp-consulta-content">

                <div class="snrp-consulta-icon">
                    <i class="bi bi-qr-code-scan"></i>
                </div>

                <h4>Consultar Património</h4>

                <p>
                    Introduza o código único do património para consultar
                    as informações públicas disponíveis.
                </p>


                <form id="snrpConsultaForm">

                    <label for="codigoPatrimonio">
                        Código do Património
                    </label>

                    <div class="snrp-search-box">

                        <i class="bi bi-qr-code"></i>

                        <input
                            type="text"
                            id="codigoPatrimonio"
                            placeholder="Ex.: SNRP-CAS-000001"
                            autocomplete="off"
                        >

                    </div>


                    <button
                        type="submit"
                        class="snrp-primary-button"
                    >
                        <i class="bi bi-search"></i>
                        Consultar
                    </button>

                </form>


                <div class="snrp-public-security">
                    <i class="bi bi-shield-check"></i>

                    <span>
                        Consulta pública segura
                    </span>
                </div>

            </div>

        </div>

    </div>


    {{-- PROCESSOS E ACÇÕES --}}
    <!-- =========================================================
     GRÁFICO - PATRIMÓNIOS POR TIPO
     ========================================================= -->

<div class="snrp-dashboard-chart-grid">

<div class="snrp-panel snrp-chart-panel">

    <div class="snrp-panel-header">
        <div>
            <span class="snrp-panel-label">ANÁLISE PATRIMONIAL</span>
            <h3>Patrimónios por Tipo</h3>
            <p>Distribuição dos bens registados no SNRP.</p>
        </div>

        <div class="snrp-panel-header-icon">
            <i class="bi bi-bar-chart-line"></i>
        </div>
    </div>

    <div class="snrp-chart-container">
        <canvas id="patrimoniosPorTipoChart"></canvas>
    </div>

</div>

<div class="col-md-6"> <div class="card shadow-sm h-100"> 
    <div class="card-header"> <h5 class="card-title mb-0">
         <i class="bi bi-graph-up"></i> Registos de Patrimónios </h5> </div> <div class="card-body">
             <div style="height: 300px;"> <canvas id="graficoRegistosPatrimonios">

             </canvas> 
            </div> 
        </div>
     </div> 
    </div>

</div>
    <div class="snrp-dashboard-grid-3">

        {{-- FLUXO --}}
        <div class="snrp-panel">

            <div class="snrp-panel-header">
                <div>
                    <span class="snrp-panel-label">
                        PROCESSO
                    </span>

                    <h3>Fluxo do Registo</h3>
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


        {{-- OPERAÇÕES --}}
        <div class="snrp-panel">

            <div class="snrp-panel-header">
                <div>
                    <span class="snrp-panel-label">
                        ACESSO RÁPIDO
                    </span>

                    <h3>Operações</h3>
                </div>

                <div class="snrp-panel-header-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>
            </div>


            <div class="snrp-actions-grid">

                <a
                    href="{{ route('patrimonios.create') }}"
                    class="snrp-action"
                >
                    <i class="bi bi-plus-circle"></i>
                    <span>Novo Património</span>
                </a>


                <a
                    href="{{ route('pessoas.create') }}"
                    class="snrp-action"
                >
                    <i class="bi bi-person-plus"></i>
                    <span>Nova Pessoa</span>
                </a>


                <a
                    href="{{ route('instituicoes.create') }}"
                    class="snrp-action"
                >
                    <i class="bi bi-bank"></i>
                    <span>Nova Instituição</span>
                </a>


                <a
                    href="{{ route('transferencias-patrimoniais.create') }}"
                    class="snrp-action"
                >
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Transferir</span>
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

                    <h3>Utilizadores</h3>
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


    {{-- ESTADO DO SISTEMA --}}
    <div class="snrp-system-status-panel">

        <div class="snrp-system-status-left">

            <div class="snrp-system-status-icon">
                <i class="bi bi-activity"></i>
            </div>

            <div>
                <strong>Estado do Sistema</strong>

                <span>
                    SNRP em funcionamento normal
                </span>
            </div>

        </div>


        <div class="snrp-system-online">

            <span class="snrp-online-dot"></span>

            <strong>ONLINE</strong>

        </div>

    </div>


    {{-- RECURSOS --}}
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
                        Histórico dos movimentos
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document
        .getElementById('patrimoniosPorTipoChart');

    if (!ctx) {
        return;
    }

    const dados = @json($patrimoniosPorTipo);

    new Chart(ctx, {
        type: 'bar',

        data: {
            labels: dados.map(item => item.tipo),

            datasets: [{
                label: 'Patrimónios',
                data: dados.map(item => item.total),

                borderWidth: 0,

                borderRadius: 6,

                maxBarThickness: 45
            }]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    },

                    grid: {
                        color: '#edf0f4'
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    const ctxRegistos = document.getElementById('graficoRegistosPatrimonios');

new Chart(ctxRegistos, {

type: 'line',

data: {

labels: @json($labelsRegistos),

datasets: [{

label: 'Patrimónios registados',

data: @json($dadosRegistos),

borderWidth: 3,

tension: 0.3,

fill: false,

pointRadius: 4

}]

},

options: {

responsive: true,

maintainAspectRatio: false,

scales: {

y: {

beginAtZero: true,

ticks: {

precision: 0

}

}

}

}

});

});
</script>

@endsection