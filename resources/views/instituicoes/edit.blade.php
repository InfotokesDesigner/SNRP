@extends('layouts.snrp.app')

@section('title', 'Instituições - SNRP')

@section('page-title', 'Instituições')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h3 class="card-title">
                Lista de Instituições
            </h3>

            <a href="{{ route('instituicoes.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle me-1"></i>

                Nova Instituição

            </a>

        </div>

    </div>


    <div class="card-body">

        {{-- Mensagem de sucesso --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- Mensagem de erro --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                <i class="bi bi-exclamation-triangle me-2"></i>

                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th style="width: 60px;">
                            #
                        </th>

                        <th>
                            Instituição
                        </th>

                        <th>
                            Sigla
                        </th>

                        <th>
                            NIF
                        </th>

                        <th>
                            Telefone
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Estado
                        </th>

                        <th style="width: 180px;">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($instituicoes as $instituicao)

                        <tr>

                            <td>
                                {{ $instituicao->id }}
                            </td>

                            <td>

                                <strong>
                                    {{ $instituicao->nome }}
                                </strong>

                            </td>

                            <td>

                                <span class="badge text-bg-secondary">

                                    {{ $instituicao->sigla }}

                                </span>

                            </td>

                            <td>
                                {{ $instituicao->nif ?? '—' }}
                            </td>

                            <td>
                                {{ $instituicao->telefone ?? '—' }}
                            </td>

                            <td>
                                {{ $instituicao->email ?? '—' }}
                            </td>

                            <td>

                                @if($instituicao->ativo)

                                    <span class="badge text-bg-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Ativa

                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Inativa

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="btn-group">

                                    <a href="{{ route('instituicoes.show', $instituicao) }}"
                                       class="btn btn-sm btn-info"
                                       title="Visualizar">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <a href="{{ route('instituicoes.edit', $instituicao) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Editar">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form action="{{ route('instituicoes.destroy', $instituicao) }}"
                                          method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja eliminar esta instituição?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-building fs-1 d-block mb-3"></i>

                                    <h5>
                                        Nenhuma instituição cadastrada
                                    </h5>

                                    <p>
                                        Comece cadastrando a primeira instituição.
                                    </p>

                                    <a href="{{ route('instituicoes.create') }}"
                                       class="btn btn-primary">

                                        <i class="bi bi-plus-circle me-1"></i>

                                        Cadastrar Instituição

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Paginação --}}

        @if($instituicoes->hasPages())

            <div class="mt-3">

                {{ $instituicoes->links() }}

            </div>

        @endif

    </div>

</div>

@endsection