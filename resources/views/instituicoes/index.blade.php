
@extends('layouts.snrp.app')

@section('title', 'Instituições')

@section('content')
<div class="container-fluid">

    {{-- CABEÇALHO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-university text-primary mr-2"></i>
                Instituições
            </h1>

            <p class="text-muted mb-0">
                Gestão das instituições associadas ao SNRP.
            </p>
        </div>

        <a href="{{ route('instituicoes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i>
            Nova Instituição
        </a>
    </div>

    {{-- MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- CARTÃO PRINCIPAL --}}
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-list mr-2"></i>
                Lista de Instituições
            </h3>
        </div>

        <div class="card-body">

            @if($instituicoes->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>NIF</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th class="text-center" style="width: 170px;">
                                    Ações
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($instituicoes as $instituicao)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $instituicao->nome }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $instituicao->nif ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $instituicao->endereco ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $instituicao->telefone ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $instituicao->email ?? '—' }}
                                    </td>

                                    <td class="text-center">

                                        {{-- VISUALIZAR --}}
                                        <a href="{{ route('instituicoes.show', $instituicao) }}"
                                           class="btn btn-sm btn-info"
                                           title="Visualizar">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- EDITAR --}}
                                        <a href="{{ route('instituicoes.edit', $instituicao) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- EXCLUIR --}}
                                        <form action="{{ route('instituicoes.destroy', $instituicao) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta instituição?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else

                {{-- ESTADO VAZIO --}}
                <div class="text-center py-5">

                    <div class="mb-3">
                        <i class="fas fa-university fa-4x text-muted"></i>
                    </div>

                    <h4>Nenhuma instituição cadastrada</h4>

                    <p class="text-muted">
                        Ainda não existem instituições registadas no sistema.
                    </p>

                    <a href="{{ route('instituicoes.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i>
                        Cadastrar primeira instituição
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>
@endsection

