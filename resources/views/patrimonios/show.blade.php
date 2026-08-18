@extends('layouts.snrp.app')

@section('title', 'Visualizar Património - SNRP')

@section('page-title', 'Visualizar Património')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            <i class="bi bi-house me-1"></i>
            Dados do Património
        </h3>

        <div>

            <a href="{{ route('patrimonios.edit', $patrimonio) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil me-1"></i>
                Editar

            </a>

            <a href="{{ route('patrimonios.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Voltar

            </a>

        </div>

    </div>


    <div class="card-body">

        <div class="row g-4">

            {{-- Código --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Código
                </label>

                <div>
                    <span class="badge text-bg-primary fs-6">
                        {{ $patrimonio->codigo }}
                    </span>
                </div>

            </div>


            {{-- Estado --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Estado
                </label>

                <div>

                    @if($patrimonio->estado === 'Ativo')

                        <span class="badge text-bg-success fs-6">
                            Ativo
                        </span>

                    @elseif($patrimonio->estado === 'Transferido')

                        <span class="badge text-bg-warning fs-6">
                            Transferido
                        </span>

                    @else

                        <span class="badge text-bg-secondary fs-6">
                            Inativo
                        </span>

                    @endif

                </div>

            </div>


            {{-- Tipo --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Tipo de Património
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->tipoPatrimonio->nome ?? '—' }}

                </div>

            </div>


            {{-- Nome --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Nome do Património
                </label>

                <div class="fs-5 fw-bold">

                    {{ $patrimonio->nome }}

                </div>

            </div>


            {{-- Proprietário --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Proprietário
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->pessoa->nome_completo ?? '—' }}

                </div>

                @if($patrimonio->pessoa?->codigo_cidadao)

                    <small class="text-muted">

                        Código do cidadão:
                        {{ $patrimonio->pessoa->codigo_cidadao }}

                    </small>

                @endif

            </div>


            {{-- Instituição --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Instituição responsável
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->instituicao->nome ?? '—' }}

                </div>

                @if($patrimonio->instituicao?->sigla)

                    <small class="text-muted">

                        {{ $patrimonio->instituicao->sigla }}

                    </small>

                @endif

            </div>


            {{-- Localização --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Localização
                </label>

                <div>

                    @if($patrimonio->localizacao)

                        <i class="bi bi-geo-alt me-1"></i>

                        {{ $patrimonio->localizacao }}

                    @else

                        <span class="text-muted">
                            Não informada
                        </span>

                    @endif

                </div>

            </div>


            {{-- Coordenadas --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Latitude
                </label>

                <div>

                    {{ $patrimonio->latitude ?? '—' }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label text-muted">
                    Longitude
                </label>

                <div>

                    {{ $patrimonio->longitude ?? '—' }}

                </div>

            </div>


            {{-- Descrição --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Descrição
                </label>

                <div class="border rounded p-3 bg-light">

                    @if($patrimonio->descricao)

                        {!! nl2br(e($patrimonio->descricao)) !!}

                    @else

                        <span class="text-muted">
                            Nenhuma descrição informada.
                        </span>

                    @endif

                </div>

            </div>


            {{-- Datas --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Registado em
                </label>

                <div>

                    {{ $patrimonio->created_at?->format('d/m/Y H:i') ?? '—' }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label text-muted">
                    Última atualização
                </label>

                <div>

                    {{ $patrimonio->updated_at?->format('d/m/Y H:i') ?? '—' }}

                </div>

            </div>

        </div>

    </div>


    <div class="card-footer">

        <a href="{{ route('patrimonios.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Voltar para a lista

        </a>

    </div>

</div>

@endsection