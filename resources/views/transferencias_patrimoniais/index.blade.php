@extends('layouts.snrp.app')

@section('title', 'Transferências Patrimoniais')

@section('page-title', 'Transferências Patrimoniais')

@section('content')

<div class="card">

    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">

            <h3 class="card-title mb-0">
                Histórico de Transferências
            </h3>

            <a href="{{ route('transferencias-patrimoniais.create') }}"
               class="btn btn-primary">
                <i class="bi bi-arrow-left-right"></i>
                Nova Transferência
            </a>

        </div>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fechar">
                </button>
            </div>
        @endif

        @if($transferencias->isEmpty())

            <div class="text-center py-5">

                <i class="bi bi-arrow-left-right fs-1 text-muted"></i>

                <h5 class="mt-3">
                    Nenhuma transferência registada
                </h5>

                <p class="text-muted">
                    Ainda não existem transferências patrimoniais no sistema.
                </p>

                <a href="{{ route('transferencias-patrimoniais.create') }}"
                   class="btn btn-primary">
                    Registrar primeira transferência
                </a>

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Património</th>
                            <th>Proprietário anterior</th>
                            <th>Novo proprietário</th>
                            <th>Data</th>
                            <th class="text-center">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($transferencias as $transferencia)

                            <tr>

                                <td>
                                    {{ $transferencia->id }}
                                </td>

                                <td>

                                    @if($transferencia->patrimonio)

                                        <strong>
                                            {{ $transferencia->patrimonio->codigo }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $transferencia->patrimonio->nome }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            Património removido
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($transferencia->proprietarioAnterior)

                                        {{ $transferencia->proprietarioAnterior->nome_completo }}

                                    @else

                                        <span class="text-muted">
                                            Não disponível
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($transferencia->novoProprietario)

                                        {{ $transferencia->novoProprietario->nome_completo }}

                                    @else

                                        <span class="text-muted">
                                            Não disponível
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $transferencia->data_transferencia?->format('d/m/Y') }}
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('transferencias-patrimoniais.show', $transferencia) }}"
                                       class="btn btn-sm btn-info text-white"
                                       title="Ver detalhes">

                                        <i class="bi bi-eye"></i>
                                        Ver

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection