@extends('layouts.snrp.app')

@section('title', 'Auditoria')

@section('page-title', 'Auditoria do Sistema')

@section('content')

<div class="card">

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            <i class="bi bi-shield-check me-2"></i>
            Histórico de Auditoria
        </h3>

        <span class="badge bg-primary">
            {{ $auditorias->total() }} registo(s)
        </span>

    </div>
</div>

<div class="card-body">

    {{-- Filtros --}}
    <form method="GET"
          action="{{ route('auditorias.index') }}"
          class="mb-4">

        <div class="row g-3">

            {{-- Pesquisa --}}
            <div class="col-md-4">

                <label for="pesquisa" class="form-label">
                    Pesquisar
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                           id="pesquisa"
                           name="pesquisa"
                           class="form-control"
                           value="{{ request('pesquisa') }}"
                           placeholder="Descrição, ação, módulo ou utilizador">

                </div>

            </div>

            {{-- Ação --}}
            <div class="col-md-2">

                <label for="acao" class="form-label">
                    Ação
                </label>

                <select name="acao"
                        id="acao"
                        class="form-select">

                    <option value="">
                        Todas
                    </option>

                    @foreach($acoes as $acao)

                        <option value="{{ $acao }}"
                            @selected(request('acao') === $acao)>
                            {{ ucfirst($acao) }}
                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Módulo --}}
            <div class="col-md-3">

                <label for="modulo" class="form-label">
                    Módulo
                </label>

                <select name="modulo"
                        id="modulo"
                        class="form-select">

                    <option value="">
                        Todos
                    </option>

                    @foreach($modulos as $modulo)

                        <option value="{{ $modulo }}"
                            @selected(request('modulo') === $modulo)>
                            {{ ucfirst(str_replace('_', ' ', $modulo)) }}
                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Utilizador --}}
            <div class="col-md-3">

                <label for="user_id" class="form-label">
                    Utilizador
                </label>

                <select name="user_id"
                        id="user_id"
                        class="form-select">

                    <option value="">
                        Todos
                    </option>

                    @foreach($utilizadores as $utilizador)

                        <option value="{{ $utilizador->id }}"
                            @selected((string) request('user_id') === (string) $utilizador->id)>
                            {{ $utilizador->name }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <div class="d-flex gap-2 mt-3">

            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-funnel me-1"></i>
                Filtrar

            </button>

            <a href="{{ route('auditorias.index') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-x-circle me-1"></i>
                Limpar

            </a>

        </div>

    </form>


    {{-- Lista --}}
    @if($auditorias->isEmpty())

        <div class="text-center py-5">

            <i class="bi bi-shield-check fs-1 text-muted"></i>

            <h5 class="mt-3">
                Nenhum registo de auditoria encontrado
            </h5>

            <p class="text-muted">
                Não existem registos que correspondam aos filtros selecionados.
            </p>

        </div>

    @else

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Data/Hora</th>

                        <th>Utilizador</th>

                        <th>Ação</th>

                        <th>Módulo</th>

                        <th>Descrição</th>

                        <th class="text-center">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($auditorias as $auditoria)

                        <tr>

                            <td>
                                {{ $auditoria->id }}
                            </td>

                            <td>

                                <strong>
                                    {{ $auditoria->created_at?->format('d/m/Y') }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $auditoria->created_at?->format('H:i:s') }}
                                </small>

                            </td>

                            <td>

                                @if($auditoria->user)

                                    <strong>
                                        {{ $auditoria->user->name }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        {{ $auditoria->user->email }}
                                    </small>

                                @else

                                    <span class="text-muted">
                                        Sistema / Não identificado
                                    </span>

                                @endif

                            </td>

                            <td>

                                @php

                                    $badgeClass = match($auditoria->acao) {
                                        'login' => 'bg-success',
                                        'logout' => 'bg-secondary',
                                        'criar' => 'bg-primary',
                                        'editar' => 'bg-warning text-dark',
                                        'eliminar' => 'bg-danger',
                                        'visualizar' => 'bg-info text-dark',
                                        'transferir' => 'bg-primary',
                                        default => 'bg-dark',
                                    };

                                @endphp

                                <span class="badge {{ $badgeClass }}">
                                    {{ $auditoria->acao_formatada }}
                                </span>

                            </td>

                            <td>

                                @if($auditoria->modulo)

                                    <span class="badge bg-light text-dark border">
                                        {{ ucfirst(str_replace('_', ' ', $auditoria->modulo)) }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $auditoria->descricao ?? 'Sem descrição' }}

                            </td>

                            <td class="text-center">

                                <a href="{{ route('auditorias.show', $auditoria) }}"
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

        {{-- Paginação --}}
        <div class="d-flex justify-content-center mt-4">

            {{ $auditorias->links() }}

        </div>

    @endif

</div>


</div>

@endsection
