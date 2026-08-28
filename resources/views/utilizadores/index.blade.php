@extends('layouts.snrp.app')

@section('title', 'Utilizadores')
@section('page-title', 'Utilizadores')

@section('content')

<div class="container-fluid">

{{-- CABEÇALHO DA PÁGINA --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="h3 mb-1">
            <i class="bi bi-people-fill text-primary me-2"></i>
            Utilizadores
        </h1>

        <p class="text-muted mb-0">
            Gestão dos utilizadores e respectivos acessos ao SNRP.
        </p>
    </div>

    <a href="{{ route('utilizadores.create') }}"
       class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i>
        Novo Utilizador
    </a>

</div>


{{-- MENSAGEM DE SUCESSO --}}
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show"
         role="alert">

        <i class="bi bi-check-circle-fill me-2"></i>

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>

    </div>

@endif


{{-- MENSAGEM DE ERRO --}}
@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show"
         role="alert">

        <i class="bi bi-exclamation-triangle-fill me-2"></i>

        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fechar">
        </button>

    </div>

@endif


{{-- CARTÃO PRINCIPAL --}}
<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-list-ul me-2"></i>
                Lista de Utilizadores
            </h5>

            <span class="badge bg-light text-primary">
                {{ $utilizadores->total() }}
                utilizador(es)
            </span>

        </div>

    </div>


    <div class="card-body">

        @if($utilizadores->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-light">

                        <tr>

                            <th style="width: 60px;">#</th>

                            <th>Nome</th>

                            <th>E-mail</th>

                            <th>Perfil</th>

                            <th>Instituição</th>

                            <th class="text-center">Estado</th>

                            <th class="text-center" style="width: 180px;">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($utilizadores as $utilizador)

                            <tr>

                                <td>
                                    {{ $utilizadores->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                             style="width: 38px; height: 38px;">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <strong>
                                            {{ $utilizador->name }}
                                        </strong>

                                    </div>

                                </td>


                                <td>
                                    {{ $utilizador->email }}
                                </td>


                                <td>

                                    @if($utilizador->role)

                                        <span class="badge bg-info text-dark">
                                            {{ $utilizador->role->nome }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Não definido
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($utilizador->instituicao)

                                        {{ $utilizador->instituicao->nome }}

                                    @else

                                        <span class="text-muted">
                                            Não definida
                                        </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    @if($utilizador->ativo)

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Ativo
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Inativo
                                        </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    {{-- VISUALIZAR --}}
                                    <a href="{{ route('utilizadores.show', $utilizador) }}"
                                       class="btn btn-sm btn-info text-white"
                                       title="Visualizar">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- EDITAR --}}
                                    <a href="{{ route('utilizadores.edit', $utilizador) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Editar">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- ELIMINAR --}}
                                    @if($utilizador->id !== auth()->id())

                                        <form action="{{ route('utilizadores.destroy', $utilizador) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja eliminar este utilizador?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Eliminar">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINAÇÃO --}}
            <div class="mt-4">

                {{ $utilizadores->links() }}

            </div>


        @else

            {{-- ESTADO VAZIO --}}
            <div class="text-center py-5">

                <div class="mb-3">

                    <i class="bi bi-people-fill text-muted"
                       style="font-size: 4rem;">
                    </i>

                </div>

                <h4>
                    Nenhum utilizador cadastrado
                </h4>

                <p class="text-muted">
                    Ainda não existem utilizadores registados no sistema.
                </p>

                <a href="{{ route('utilizadores.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-person-plus-fill me-1"></i>

                    Cadastrar primeiro utilizador

                </a>

            </div>

        @endif

    </div>

</div>


</div>

@endsection
