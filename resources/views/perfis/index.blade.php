@extends('layouts.snrp.app')

@section('title', 'Perfis e Permissões')

@section('content')
<div class="container-fluid py-4">

    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-shield-lock me-2"></i>
                Perfis e Permissões
            </h2>

            <p class="text-muted mb-0">
                Gerencie os perfis de acesso e as permissões dos utilizadores.
            </p>
        </div>

        @if(auth()->user()->hasPermission('perfis.criar'))
            <a href="{{ route('perfis.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Novo Perfil
            </a>
        @endif
    </div>


    {{-- Mensagens --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Tabela --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-people-fill text-primary me-2"></i>

                <strong>Perfis de Acesso</strong>

                <span class="badge bg-primary ms-2">
                    {{ $roles->total() }}
                </span>
            </div>
        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Perfil</th>
                            <th>Descrição</th>
                            <th class="text-center">Utilizadores</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($roles as $role)

                            <tr>

                                {{-- Perfil --}}
                                <td class="ps-4">

                                    <div class="d-flex align-items-center">

                                        <div class="rounded-circle bg-primary bg-opacity-10
                                                    d-flex align-items-center justify-content-center
                                                    me-3"
                                             style="width:42px;height:42px;">

                                            <i class="bi bi-shield-check text-primary"></i>

                                        </div>

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $role->nome }}
                                            </div>

                                            <small class="text-muted">
                                                ID: {{ $role->id }}
                                            </small>
                                        </div>

                                    </div>

                                </td>


                                {{-- Descrição --}}
                                <td>

                                    @if($role->descricao)
                                        <span>
                                            {{ $role->descricao }}
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            Sem descrição
                                        </span>
                                    @endif

                                </td>


                                {{-- Utilizadores --}}
                                <td class="text-center">

                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $role->users_count }}
                                    </span>

                                </td>


                                {{-- Estado --}}
                                <td class="text-center">

                                    @if($role->ativo)

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Ativo
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Inativo
                                        </span>

                                    @endif

                                </td>


                                {{-- Ações --}}
                                <td class="text-end pe-4">

                                    <div class="btn-group" role="group">

                                        @if(auth()->user()->hasPermission('perfis.visualizar'))
                                            <a href="{{ route('perfis.show', $role) }}"
                                               class="btn btn-sm btn-outline-info"
                                               title="Visualizar">

                                                <i class="bi bi-eye"></i>

                                            </a>
                                        @endif


                                        @if(auth()->user()->hasPermission('perfis.editar'))
                                            <a href="{{ route('perfis.edit', $role) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Editar">

                                                <i class="bi bi-pencil"></i>

                                            </a>
                                        @endif


                                        @if(auth()->user()->hasPermission('perfis.eliminar')
                                            && $role->users_count === 0)

                                            <form action="{{ route('perfis.destroy', $role) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Tem certeza que deseja eliminar este perfil?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Eliminar">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-shield-x fs-1 d-block mb-3"></i>

                                        <h5>Nenhum perfil encontrado</h5>

                                        <p class="mb-0">
                                            Ainda não existem perfis de acesso registados.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Paginação --}}
        @if($roles->hasPages())

            <div class="card-footer bg-white">
                {{ $roles->links() }}
            </div>

        @endif

    </div>

</div>
@endsection