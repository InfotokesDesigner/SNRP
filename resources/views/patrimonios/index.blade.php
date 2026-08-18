@extends('layouts.snrp.app')

@section('title', 'Patrimónios - SNRP')

@section('page-title', 'Patrimónios')

@section('content')

<div class="card">

    {{-- Cabeçalho --}}
    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            Lista de Patrimónios
        </h3>

        <a href="{{ route('patrimonios.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Novo Património

        </a>

    </div>


    <div class="card-body">

        {{-- Mensagem de sucesso --}}
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


        {{-- Mensagem de erro --}}
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
              action="{{ route('patrimonios.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-10">

                <input
                    type="text"
                    name="pesquisa"
                    class="form-control"
                    placeholder="Pesquisar por código, nome ou localização..."
                    value="{{ request('pesquisa') }}"
                >

            </div>

            <div class="col-md-2 d-grid">

                <button type="submit"
                        class="btn btn-secondary">

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

                        <th>Património</th>

                        <th>Tipo</th>

                        <th>Proprietário</th>

                        <th>Instituição</th>

                        <th>Estado</th>

                        <th class="text-end">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($patrimonios as $patrimonio)

                        <tr>

                            {{-- Número --}}
                            <td>

                                {{ $loop->iteration + (($patrimonios->currentPage() - 1) * $patrimonios->perPage()) }}

                            </td>


                            {{-- Código --}}
                            <td>

                                <span class="badge text-bg-primary">

                                    {{ $patrimonio->codigo }}

                                </span>

                            </td>


                            {{-- Nome --}}
                            <td>

                                <strong>

                                    {{ $patrimonio->nome }}

                                </strong>

                                @if($patrimonio->localizacao)

                                    <br>

                                    <small class="text-muted">

                                        <i class="bi bi-geo-alt"></i>

                                        {{ $patrimonio->localizacao }}

                                    </small>

                                @endif

                            </td>


                            {{-- Tipo --}}
                            <td>

                                {{ $patrimonio->tipoPatrimonio->nome ?? '—' }}

                            </td>


                            {{-- Proprietário --}}
                            <td>

                                {{ $patrimonio->pessoa->nome_completo ?? '—' }}

                            </td>


                            {{-- Instituição --}}
                            <td>

                                {{ $patrimonio->instituicao->nome ?? '—' }}

                            </td>


                            {{-- Estado --}}
                            <td>

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

                            </td>


                            {{-- Ações --}}
                            <td class="text-end">

                                <div class="btn-group">


                                    {{-- Visualizar --}}
                                    <a
                                        href="{{ route('patrimonios.show', $patrimonio) }}"
                                        class="btn btn-sm btn-outline-info"
                                        title="Visualizar">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Editar --}}
                                    <a
                                        href="{{ route('patrimonios.edit', $patrimonio) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Editar">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Eliminar --}}
                                    <form
                                        method="POST"
                                        action="{{ route('patrimonios.destroy', $patrimonio) }}"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar este património?');">

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

                            <td colspan="8"
                                class="text-center py-5">

                                <i class="bi bi-house fs-1 text-muted"></i>

                                <p class="mt-2 mb-0 text-muted">

                                    Nenhum património encontrado.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Paginação --}}
    @if($patrimonios->hasPages())

        <div class="card-footer">

            {{ $patrimonios->links() }}

        </div>

    @endif

</div>

@endsection