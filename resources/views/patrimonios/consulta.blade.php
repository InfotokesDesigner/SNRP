@extends('layouts.snrp.app')

@section('title', 'Consulta de Património - SNRP')

@section('page-title', 'Consulta de Património')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header text-center">

            <h3 class="mb-1">
                <i class="bi bi-qr-code me-2"></i>
                Consulta de Património
            </h3>

            <small class="text-muted">
                Sistema de Registo Patrimonial - SNRP
            </small>

        </div>

        <div class="card-body">

            <div class="text-center mb-4">

                <span class="badge text-bg-success fs-6">
                    Património encontrado
                </span>

            </div>


            <div class="row g-4">

                {{-- Código --}}
                <div class="col-md-6">

                    <label class="form-label text-muted">
                        Código do Património
                    </label>

                    <div class="fw-bold fs-5">
                        {{ $patrimonio->codigo }}
                    </div>

                </div>


                {{-- Estado --}}
                <div class="col-md-6">

                    <label class="form-label text-muted">
                        Estado
                    </label>

                    <div>

                        @if($patrimonio->estado === 'Ativo')

                            <span class="badge text-bg-success">
                                Ativo
                            </span>

                        @elseif($patrimonio->estado === 'Transferido')

                            <span class="badge text-bg-warning">
                                Transferido
                            </span>

                        @else

                            <span class="badge text-bg-secondary">
                                Inativo
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Nome --}}
                <div class="col-md-12">

                    <label class="form-label text-muted">
                        Património
                    </label>

                    <div class="fs-4 fw-bold">
                        {{ $patrimonio->nome }}
                    </div>

                </div>


                {{-- Tipo --}}
                <div class="col-md-6">

                    <label class="form-label text-muted">
                        Tipo de Património
                    </label>

                    <div>
                        {{ $patrimonio->tipoPatrimonio->nome ?? 'Não informado' }}
                    </div>

                </div>


                {{-- Instituição --}}
                <div class="col-md-6">

                    <label class="form-label text-muted">
                        Instituição responsável
                    </label>

                    <div>
                        {{ $patrimonio->instituicao->nome ?? 'Não informado' }}
                    </div>

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
                @if($patrimonio->latitude && $patrimonio->longitude)

                    <div class="col-md-6">

                        <label class="form-label text-muted">
                            Latitude
                        </label>

                        <div>
                            {{ $patrimonio->latitude }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label text-muted">
                            Longitude
                        </label>

                        <div>
                            {{ $patrimonio->longitude }}
                        </div>

                    </div>

                @endif


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

            </div>

        </div>


        <div class="card-footer text-center">

            <small class="text-muted">

                Consulta pública através do Sistema de Registo Patrimonial
                (SNRP).

            </small>

        </div>

    </div>

</div>

@endsection