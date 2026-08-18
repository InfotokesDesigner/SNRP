@extends('layouts.snrp.app')

@section('title', 'Tipos de Património - SNRP')

@section('page-title', 'Tipos de Património')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            Lista de Tipos de Património
        </h3>

        <a href="{{ route('tipos-patrimonio.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Novo Tipo
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
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- Pesquisa --}}
        <form method="GET"
              action="{{ route('tipos-patrimonio.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-10">

                <input
                    type="text"
                    name="pesquisa"
                    class="form-control"
                    placeholder="Pesquisar por nome ou descrição..."
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

                        <th>Nome</th>

                        <th>Descrição</th>

                        <th>Estado</th>

                        <th class="text-end">Ações</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tipos as $tipo)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($tipos->currentPage() - 1) * $tipos->perPage() }}
                            </td>

                            <td>
                                <strong>
                                    {{ $tipo->nome }}
                                </strong>
                            </td>

                            <td>
                                {{ $tipo->descricao ?? '—' }}
                            </td>

                            <td>

                                @if($tipo->ativo)

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
                                        href="{{ route('tipos-patrimonio.show', $tipo) }}"
                                        class="btn btn-sm btn-outline-info"
                                        title="Visualizar">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('tipos-patrimonio.edit', $tipo) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Editar">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('tipos-patrimonio.destroy', $tipo) }}"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar este tipo de património?');">

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

                            <td colspan="5" class="text-center py-4">

                                <i class="bi bi-folder2-open fs-1 text-muted"></i>

                                <p class="mt-2 mb-0 text-muted">
                                    Nenhum tipo de património encontrado.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($tipos->hasPages())

        <div class="card-footer">

            {{ $tipos->links() }}

        </div>

    @endif

</div>

@endsection