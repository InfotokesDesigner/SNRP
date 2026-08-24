@extends('layouts.snrp.public')

@section('title', 'Consulta Pública de Património - SNRP')

@section('content')

<div class="mb-4">

    <div class="text-center">

        <div class="mb-2">
            <span class="badge text-bg-primary px-3 py-2">
                <i class="bi bi-qr-code me-1"></i>
                Consulta Pública
            </span>
        </div>

        <h1 class="fw-bold mb-1">
            Consulta de Património
        </h1>

        <p class="text-muted mb-0">
            Informação disponibilizada pelo Sistema de Registo Patrimonial
        </p>

    </div>

</div>


{{-- Património --}}
<div class="card border-0 shadow-sm overflow-hidden">

    {{-- Cabeçalho --}}
    <div class="card-header bg-white p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <small class="text-muted d-block mb-1">
                    Código do Património
                </small>

                <span class="badge text-bg-primary fs-6">
                    {{ $patrimonio->codigo }}
                </span>

            </div>


            <div>

                @if($patrimonio->estado === 'Ativo')

                    <span class="badge text-bg-success fs-6 px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>
                        Ativo
                    </span>

                @elseif($patrimonio->estado === 'Transferido')

                    <span class="badge text-bg-warning fs-6 px-3 py-2">
                        <i class="bi bi-arrow-left-right me-1"></i>
                        Transferido
                    </span>

                @else

                    <span class="badge text-bg-secondary fs-6 px-3 py-2">
                        <i class="bi bi-dash-circle me-1"></i>
                        Inativo
                    </span>

                @endif

            </div>

        </div>

    </div>


    <div class="card-body p-4">

        <div class="row g-4">

            {{-- Fotografia principal --}}
            @php
                $fotografiaPrincipal = $patrimonio->fotografias
                    ->firstWhere('principal', true);
            @endphp

            @if($fotografiaPrincipal)

                <div class="col-12">

                    <div class="rounded overflow-hidden shadow-sm">

                        <img
                            src="{{ asset('storage/' . $fotografiaPrincipal->caminho) }}"
                            class="patrimonio-photo"
                            alt="{{ $fotografiaPrincipal->descricao ?? 'Fotografia do património' }}"
                        >

                    </div>

                    @if($fotografiaPrincipal->descricao)

                        <div class="text-muted small mt-2">
                            <i class="bi bi-camera me-1"></i>
                            {{ $fotografiaPrincipal->descricao }}
                        </div>

                    @endif

                </div>

            @endif

            {{-- Outras fotografias --}}
@php
    $outrasFotografias = $patrimonio->fotografias
        ->filter(fn ($fotografia) => !$fotografia->principal);
@endphp

@if($outrasFotografias->count() > 0)

    <div class="col-12">

        <div class="border rounded p-3">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    <i class="bi bi-images me-1"></i>
                    Outras Fotografias
                </h5>

                <span class="badge text-bg-secondary">
                    {{ $outrasFotografias->count() }}
                </span>

            </div>

            <div class="row g-3">

                @foreach($outrasFotografias as $fotografia)

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="card h-100 shadow-sm">

                            <img
                                src="{{ asset('storage/' . $fotografia->caminho) }}"
                                class="card-img-top"
                                alt="{{ $fotografia->descricao ?? 'Fotografia do património' }}"
                                style="height: 180px; object-fit: cover;"
                            >

                            @if($fotografia->descricao)

                                <div class="card-body p-2">

                                    <small class="text-muted">
                                        <i class="bi bi-camera me-1"></i>
                                        {{ $fotografia->descricao }}
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endif

            {{-- Nome --}}
            <div class="col-12">

                <small class="text-muted d-block mb-1">
                    Património
                </small>

                <h2 class="fw-bold mb-0">
                    {{ $patrimonio->nome }}
                </h2>

            </div>


            {{-- Tipo --}}
            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-tag me-1"></i>
                        Tipo de Património
                    </small>

                    <strong>
                        {{ $patrimonio->tipoPatrimonio->nome ?? 'Não informado' }}
                    </strong>

                </div>

            </div>


            {{-- Instituição --}}
            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-building me-1"></i>
                        Instituição responsável
                    </small>

                    <strong>
                        {{ $patrimonio->instituicao->nome ?? 'Não informado' }}
                    </strong>

                    @if($patrimonio->instituicao?->sigla)

                        <div class="small text-muted mt-1">
                            {{ $patrimonio->instituicao->sigla }}
                        </div>

                    @endif

                </div>

            </div>


            {{-- Localização --}}
            <div class="col-12">

                <div class="border rounded p-3">

                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-geo-alt me-1"></i>
                        Localização
                    </small>

                    @if($patrimonio->localizacao)

                        <strong>
                            {{ $patrimonio->localizacao }}
                        </strong>

                    @else

                        <span class="text-muted">
                            Não informada
                        </span>

                    @endif

                </div>

            </div>


            {{-- Coordenadas --}}
            @if($patrimonio->latitude !== null && $patrimonio->longitude !== null)

                <div class="col-md-6">

                    <div class="border rounded p-3">

                        <small class="text-muted d-block mb-1">
                            Latitude
                        </small>

                        <strong>
                            {{ $patrimonio->latitude }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border rounded p-3">

                        <small class="text-muted d-block mb-1">
                            Longitude
                        </small>

                        <strong>
                            {{ $patrimonio->longitude }}
                        </strong>

                    </div>

                </div>

            @endif

            {{-- Mapa de localização --}}
@if($patrimonio->latitude !== null && $patrimonio->longitude !== null)

    <div class="col-12">

        <div class="border rounded overflow-hidden">

            <div class="p-3 bg-light border-bottom">

                <h5 class="mb-0">
                    <i class="bi bi-map me-1"></i>
                    Localização no mapa
                </h5>

            </div>

            <div
                id="mapa-patrimonio"
                style="height: 400px; width: 100%;"
            ></div>

        </div>

    </div>

@endif

{{-- Mapa de localização --}}
@if($patrimonio->latitude !== null && $patrimonio->longitude !== null)

    <div class="col-12">

        <div class="border rounded overflow-hidden">

            <div class="p-3 bg-light border-bottom">

                <h5 class="mb-0">
                    <i class="bi bi-map me-1"></i>
                    Localização no mapa
                </h5>

            </div>

            <div
                id="mapa-patrimonio"
                style="height: 400px; width: 100%;"
            ></div>

        </div>

    </div>

@endif


            {{-- Descrição --}}
            <div class="col-12">

                <div class="border rounded p-3 bg-light">

                    <small class="text-muted d-block mb-2">
                        <i class="bi bi-card-text me-1"></i>
                        Descrição
                    </small>

                    @if($patrimonio->descricao)

                        <div>
                            {!! nl2br(e($patrimonio->descricao)) !!}
                        </div>

                    @else

                        <span class="text-muted">
                            Nenhuma descrição informada.
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- Rodapé do cartão --}}
    <div class="card-footer bg-white p-4">

        <div class="row align-items-center">

            <div class="col-md-8">

                <div class="small text-muted">

                    <i class="bi bi-shield-check me-1"></i>

                    Esta informação foi consultada através do
                    <strong>Sistema de Registo Patrimonial (SNRP)</strong>.

                </div>

            </div>


            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                <span class="badge text-bg-success">

                    <i class="bi bi-patch-check me-1"></i>

                    Património registado

                </span>

            </div>

        </div>

    </div>

</div>




{{-- Aviso de privacidade --}}
<div class="alert alert-light border mt-4">

    <div class="d-flex">

        <i class="bi bi-info-circle fs-4 me-3 text-primary"></i>

        <div>

            <strong>Consulta pública</strong>

            <p class="mb-0 mt-1 small text-muted">

                Esta consulta apresenta apenas informações patrimoniais
                disponibilizadas para consulta pública. Dados pessoais
                não necessários à identificação do património não são
                apresentados.

            </p>

        </div>

    </div>

</div>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitude = {{ $patrimonio->latitude ?? 'null' }};
        const longitude = {{ $patrimonio->longitude ?? 'null' }};

        if (latitude === null || longitude === null) {
            return;
        }

        const mapa = L.map('mapa-patrimonio').setView(
            [latitude, longitude],
            16
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapa);

        L.marker([latitude, longitude])
            .addTo(mapa)
            .bindPopup(
                '<strong>{{ $patrimonio->nome }}</strong><br>' +
                '{{ $patrimonio->localizacao ?? 'Localização do património' }}'
            )
            .openPopup();

    });
</script>

@endpush

@endsection