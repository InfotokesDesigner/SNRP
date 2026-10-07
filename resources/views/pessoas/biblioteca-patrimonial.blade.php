@extends('layouts.snrp.app')

@section('title', 'Biblioteca Patrimonial')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-1 text-white">
        <i class="bi bi-collection me-2"></i>
    Biblioteca Patrimonial
           </h1>

            <p class="text-white-50 mb-0">
    Patrimónios atualmente associados ao proprietário.
            </p>
        </div>

        <a href="{{ route('pessoas.show', $pessoa) }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Voltar
        </a>

    </div>


    {{-- DADOS DO PROPRIETÁRIO --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>
                <i class="bi bi-person me-2"></i>
                Proprietário
            </strong>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <strong>Nome completo</strong>
                    <div>
                        {{ $pessoa->nome_completo }}
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>NIF</strong>
                    <div>
                        {{ $pessoa->nif ?: 'Não informado' }}
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Código do cidadão</strong>
                    <div>
                        {{ $pessoa->codigo_cidadao }}
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- RESUMO --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center">

                <i class="bi bi-buildings fs-1 text-primary me-3"></i>

                <div>
                    <div class="text-muted">
                        Patrimónios atuais
                    </div>

                    <div class="fs-3 fw-bold">
                        {{ $pessoa->patrimonios->count() }}
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- LISTA DE PATRIMÓNIOS --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <strong>
                <i class="bi bi-list-ul me-2"></i>
                Patrimónios
            </strong>
        </div>

        <div class="card-body">

            @if($pessoa->patrimonios->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>
                                <th>Código</th>
                                <th>Património</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th class="text-end">Ações</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($pessoa->patrimonios as $patrimonio)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $patrimonio->codigo }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $patrimonio->nome }}
                                    </td>

                                    <td>
                                        {{ $patrimonio->tipoPatrimonio?->nome ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $patrimonio->estado }}
                                    </td>

                                    <td class="text-end">

                                        <a href="{{ route('patrimonios.show', $patrimonio) }}"
                                           class="btn btn-sm btn-primary">

                                            <i class="bi bi-eye"></i>
                                            Ver
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info mb-0">

                    <i class="bi bi-info-circle me-2"></i>

                    Esta pessoa ainda não possui patrimónios atualmente
                    associados.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection