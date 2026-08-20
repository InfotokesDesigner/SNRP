@extends('layouts.snrp.app')

@section('title', 'Detalhes da Transferência')

@section('page-title', 'Detalhes da Transferência Patrimonial')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-9">

        {{-- Cabeçalho --}}
        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h3 class="card-title mb-0">
                    Transferência Patrimonial #{{ $transferencia->id }}
                </h3>

                <a href="{{ route('transferencias-patrimoniais.index') }}"
                   class="btn btn-secondary btn-sm">

                    <i class="bi bi-arrow-left"></i>
                    Voltar ao histórico

                </a>

            </div>

        </div>


        {{-- Património --}}
        <div class="card mb-4">

            <div class="card-header">

                <h3 class="card-title mb-0">
                    <i class="bi bi-house-door"></i>
                    Património
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label text-muted">
                            Código
                        </label>

                        <div class="fw-bold">
                            {{ $transferencia->patrimonio->codigo ?? '—' }}
                        </div>

                    </div>


                    <div class="col-md-5 mb-3">

                        <label class="form-label text-muted">
                            Nome
                        </label>

                        <div class="fw-bold">
                            {{ $transferencia->patrimonio->nome ?? '—' }}
                        </div>

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label text-muted">
                            Data da transferência
                        </label>

                        <div class="fw-bold">

                            {{ $transferencia->data_transferencia
                                ? $transferencia->data_transferencia->format('d/m/Y')
                                : '—'
                            }}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Transferência --}}
        <div class="card mb-4">

            <div class="card-header">

                <h3 class="card-title mb-0">
                    <i class="bi bi-arrow-left-right"></i>
                    Alteração de Proprietário
                </h3>

            </div>

            <div class="card-body">

                <div class="row align-items-center">

                    {{-- Proprietário anterior --}}
                    <div class="col-md-5">

                        <div class="border rounded p-4 h-100">

                            <div class="text-muted mb-2">
                                Proprietário anterior
                            </div>

                            <h4 class="mb-2">

                                {{ $transferencia->proprietarioAnterior->nome_completo ?? '—' }}

                            </h4>

                            @if($transferencia->proprietarioAnterior)

                                <div class="small text-muted">

                                    Código do cidadão:
                                    <strong>
                                        {{ $transferencia->proprietarioAnterior->codigo_cidadao ?? '—' }}
                                    </strong>

                                </div>

                                @if($transferencia->proprietarioAnterior->bi)

                                    <div class="small text-muted mt-1">

                                        BI:
                                        <strong>
                                            {{ $transferencia->proprietarioAnterior->bi }}
                                        </strong>

                                    </div>

                                @endif

                            @endif

                        </div>

                    </div>


                    {{-- Seta --}}
                    <div class="col-md-2 text-center my-3 my-md-0">

                        <div class="fs-1 text-primary">

                            <i class="bi bi-arrow-right"></i>

                        </div>

                        <div class="small text-muted">
                            Transferência
                        </div>

                    </div>


                    {{-- Novo proprietário --}}
                    <div class="col-md-5">

                        <div class="border rounded p-4 h-100">

                            <div class="text-muted mb-2">
                                Novo proprietário
                            </div>

                            <h4 class="mb-2">

                                {{ $transferencia->novoProprietario->nome_completo ?? '—' }}

                            </h4>

                            @if($transferencia->novoProprietario)

                                <div class="small text-muted">

                                    Código do cidadão:
                                    <strong>
                                        {{ $transferencia->novoProprietario->codigo_cidadao ?? '—' }}
                                    </strong>

                                </div>

                                @if($transferencia->novoProprietario->bi)

                                    <div class="small text-muted mt-1">

                                        BI:
                                        <strong>
                                            {{ $transferencia->novoProprietario->bi }}
                                        </strong>

                                    </div>

                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Observação --}}
        <div class="card mb-4">

            <div class="card-header">

                <h3 class="card-title mb-0">
                    <i class="bi bi-chat-left-text"></i>
                    Observação
                </h3>

            </div>

            <div class="card-body">

                @if($transferencia->observacao)

                    <p class="mb-0">
                        {{ $transferencia->observacao }}
                    </p>

                @else

                    <span class="text-muted">
                        Nenhuma observação registada.
                    </span>

                @endif

            </div>

        </div>


        {{-- Informações do registro --}}
        <div class="card mb-4">

            <div class="card-header">

                <h3 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    Informações do Registro
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <span class="text-muted">
                            Registro criado em:
                        </span>

                        <strong>
                            {{ $transferencia->created_at
                                ? $transferencia->created_at->format('d/m/Y H:i')
                                : '—'
                            }}
                        </strong>

                    </div>


                    <div class="col-md-6 mb-3">

                        <span class="text-muted">
                            Última atualização:
                        </span>

                        <strong>
                            {{ $transferencia->updated_at
                                ? $transferencia->updated_at->format('d/m/Y H:i')
                                : '—'
                            }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- Botões --}}
        <div class="d-flex justify-content-between mb-4">

            <a href="{{ route('transferencias-patrimoniais.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Voltar

            </a>


            @if($transferencia->patrimonio)

                <a href="{{ route('patrimonios.show', $transferencia->patrimonio) }}"
                   class="btn btn-primary">

                    <i class="bi bi-house-door"></i>
                    Ver Património

                </a>

            @endif

        </div>

    </div>

</div>

@endsection