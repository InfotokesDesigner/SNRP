@extends('layouts.snrp.app')

@section('title', 'Biblioteca Patrimonial')

@section('content')

<div class="container-fluid">

    {{-- CABEÇALHO --}}
    <div class="mb-4">

       <h1 class="h3 mb-1 text-white">
            <i class="bi bi-collection me-2"></i>
            Biblioteca Patrimonial
        </h1>

       <p class="text-white-50 mb-0">
            Pesquise e consulte os patrimónios associados a cada pessoa.
        </p>

    </div>


    {{-- PESQUISA --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>
                <i class="bi bi-search me-2"></i>
                Pesquisar proprietário
            </strong>
        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('biblioteca-patrimonial.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-10">

                        <label class="form-label">
                            NIF, Código do Cidadão, ID ou Nome
                        </label>

                        <input
                            type="text"
                            name="q"
                            value="{{ $termo }}"
                            class="form-control"
                            placeholder="Ex.: 123456789, SNRP-PES-000001 ou João Manuel"
                        >

                    </div>

                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search me-1"></i>
                            Pesquisar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- RESULTADOS --}}
    @if($termo !== '')

        <div class="card shadow-sm">

            <div class="card-header">

                <strong>
                    Resultados da pesquisa
                </strong>

                <span class="text-muted">
                    — "{{ $termo }}"
                </span>

            </div>

            <div class="card-body">

                @if($pessoas->count())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>NIF</th>
                                    <th>Patrimónios</th>
                                    <th class="text-end">Ação</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($pessoas as $pessoa)

                                    <tr>

                                        <td>
                                            {{ $pessoa->id }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $pessoa->codigo_cidadao }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $pessoa->nome_completo }}
                                        </td>

                                        <td>
                                            {{ $pessoa->nif ?: 'Não informado' }}
                                        </td>

                                        <td>

                                            <span class="badge bg-primary">
                                                {{ $pessoa->patrimonios_count }}
                                            </span>

                                        </td>

                                        <td class="text-end">

                                            <a
                                                href="{{ route('pessoas.biblioteca-patrimonial', $pessoa) }}"
                                                class="btn btn-sm btn-primary"
                                            >

                                                <i class="bi bi-collection me-1"></i>
                                                Abrir Biblioteca

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="alert alert-warning mb-0">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        Nenhuma pessoa foi encontrada com o termo
                        <strong>{{ $termo }}</strong>.

                    </div>

                @endif

            </div>

        </div>

    @else

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-collection fs-1 text-primary"></i>

                <h4 class="mt-3">
                    Biblioteca Patrimonial
                </h4>

                <p class="text-muted mb-0">
                    Pesquise pelo NIF, código do cidadão, ID ou nome
                    para consultar os patrimónios de uma pessoa.
                </p>

            </div>

        </div>

    @endif

</div>

@endsection