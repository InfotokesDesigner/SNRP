@extends('layouts.snrp.app')

@section('title', 'Pessoas - SNRP')

@section('page-title', 'Pessoas')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            Lista de Pessoas
        </h3>

        <a href="{{ route('pessoas.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i>
            Nova Pessoa
        </a>

    </div>

    <div class="card-body">

        {{-- Mensagens --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Pesquisa --}}
        <form method="GET"
              action="{{ route('pessoas.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-10">

                <input
                    type="text"
                    name="pesquisa"
                    class="form-control"
                    placeholder="Pesquisar por código, nome, BI, NIF ou telefone..."
                    value="{{ request('pesquisa') }}"
                >

            </div>

            <div class="col-md-2 d-grid">

                <button type="submit" class="btn btn-secondary">

                    <i class="bi bi-search me-1"></i>

                    Pesquisar

                </button>

            </div>

        </form>

        {{-- Tabela --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Código</th>

                        <th>Nome completo</th>

                        <th>BI</th>

                        <th>Telefone</th>

                        <th>Estado</th>

                        <th class="text-end">Ações</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pessoas as $pessoa)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($pessoas->currentPage() - 1) * $pessoas->perPage() }}
                            </td>

                            <td>
                                <span class="badge text-bg-primary">
                                    {{ $pessoa->codigo_cidadao ?? '—' }}
                                </span>
                            </td>

                            <td>
                                <strong>
                                    {{ $pessoa->nome_completo }}
                                </strong>
                            </td>

                            <td>
                                {{ $pessoa->bi ?? '—' }}
                            </td>

                            <td>
                                {{ $pessoa->telefone ?? '—' }}
                            </td>

                            <td>

                                @if($pessoa->ativo)

                                    <span class="badge text-bg-success">
                                        Ativo
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        Inativo
                                    </span>

                                @endif

                            </td>

                            <td class="text-end">

                                <div class="btn-group">

                                    <a
                                        href="{{ route('pessoas.show', $pessoa) }}"
                                        class="btn btn-sm btn-outline-info"
                                        title="Visualizar">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('pessoas.edit', $pessoa) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Editar">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('pessoas.destroy', $pessoa) }}"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar esta pessoa?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Eliminar">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-4">

                                <i class="bi bi-people fs-1 text-muted"></i>

                                <p class="mt-2 mb-0 text-muted">
                                    Nenhuma pessoa encontrada.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($pessoas->hasPages())

        <div class="card-footer">

            {{ $pessoas->links() }}

        </div>

    @endif

</div>

@endsection