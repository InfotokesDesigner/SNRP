@extends('layouts.snrp.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container-fluid py-4">

    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-shield-check me-2"></i>
                Editar Perfil
            </h2>

            <p class="text-muted mb-0">
                Atualize os dados e as permissões do perfil
                <strong>{{ $role->nome }}</strong>.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('perfis.show', $role) }}"
               class="btn btn-outline-info">
                <i class="bi bi-eye me-1"></i>
                Visualizar
            </a>

            <a href="{{ route('perfis.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Voltar
            </a>

        </div>
    </div>


    {{-- Erros de validação --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <div class="d-flex">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <div>
                    <strong>Não foi possível atualizar o perfil.</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    <form action="{{ route('perfis.update', $role) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Dados do perfil --}}
            <div class="col-lg-5">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-lock text-primary me-2"></i>
                            <strong>Dados do Perfil</strong>
                        </div>

                    </div>


                    <div class="card-body">

                        {{-- Identificação --}}
                        <div class="text-center mb-4">

                            <div class="rounded-circle bg-primary bg-opacity-10
                                        d-inline-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-shield-check text-primary fs-2"></i>

                            </div>

                            <h5 class="fw-bold mt-3 mb-1">
                                {{ $role->nome }}
                            </h5>

                            <small class="text-muted">
                                ID: {{ $role->id }}
                            </small>

                        </div>


                        {{-- Nome --}}
                        <div class="mb-4">

                            <label for="nome"
                                   class="form-label fw-semibold">
                                Nome do Perfil
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   id="nome"
                                   name="nome"
                                   value="{{ old('nome', $role->nome) }}"
                                   class="form-control @error('nome') is-invalid @enderror"
                                   maxlength="50"
                                   required>

                            @error('nome')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Descrição --}}
                        <div class="mb-4">

                            <label for="descricao"
                                   class="form-label fw-semibold">
                                Descrição
                            </label>

                            <textarea id="descricao"
                                      name="descricao"
                                      rows="5"
                                      class="form-control @error('descricao') is-invalid @enderror"
                                      placeholder="Descreva a finalidade deste perfil...">{{ old('descricao', $role->descricao) }}</textarea>

                            @error('descricao')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Estado --}}
                        <div class="mb-3">

                            <div class="form-check form-switch">

                                <input type="hidden"
                                       name="ativo"
                                       value="0">

                                <input class="form-check-input"
                                       type="checkbox"
                                       role="switch"
                                       id="ativo"
                                       name="ativo"
                                       value="1"
                                       {{ old('ativo', $role->ativo) ? 'checked' : '' }}>

                                <label class="form-check-label fw-semibold"
                                       for="ativo">
                                    Perfil ativo
                                </label>

                            </div>

                            <div class="form-text">
                                Desative o perfil caso ele não deva ser utilizado.
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Permissões --}}
            <div class="col-lg-7">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center">
                                <i class="bi bi-key-fill text-primary me-2"></i>
                                <strong>Permissões de Acesso</strong>
                            </div>

                            <span class="badge bg-primary">
                                {{ $permissions->flatten()->count() }} disponíveis
                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        @if($permissions->isEmpty())

                            <div class="text-center text-muted py-5">

                                <i class="bi bi-key fs-1 d-block mb-3"></i>

                                <h5>Nenhuma permissão disponível</h5>

                                <p class="mb-0">
                                    Não existem permissões ativas cadastradas.
                                </p>

                            </div>

                        @else

                            {{-- Controlos --}}
                            <div class="d-flex justify-content-between align-items-center
                                        bg-light rounded p-3 mb-4">

                                <div>
                                    <strong>Selecionar permissões</strong>

                                    <div class="small text-muted">
                                        Altere as permissões atribuídas a este perfil.
                                    </div>
                                </div>

                                <div class="d-flex gap-2">

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            id="selecionarTodas">

                                        <i class="bi bi-check2-square me-1"></i>
                                        Todas

                                    </button>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"
                                            id="limparTodas">

                                        <i class="bi bi-square me-1"></i>
                                        Limpar

                                    </button>

                                </div>

                            </div>


                            {{-- Permissões agrupadas por módulo --}}
                            <div class="row g-3">

                                @foreach($permissions as $modulo => $moduloPermissions)

                                    <div class="col-12">

                                        <div class="border rounded">

                                            {{-- Módulo --}}
                                            <div class="bg-light px-3 py-2 border-bottom">

                                                <div class="d-flex align-items-center">

                                                    <i class="bi bi-folder2-open text-primary me-2"></i>

                                                    <span class="fw-semibold text-uppercase">
                                                        {{ str_replace('_', ' ', $modulo) }}
                                                    </span>

                                                    <span class="badge bg-secondary ms-2">
                                                        {{ $moduloPermissions->count() }}
                                                    </span>

                                                </div>

                                            </div>


                                            {{-- Permissões --}}
                                            <div class="p-3">

                                                <div class="row g-2">

                                                    @foreach($moduloPermissions as $permission)

                                                        <div class="col-md-6">

                                                            <div class="form-check">

                                                                <input class="form-check-input permission-checkbox"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->id }}"
                                                                       id="permission_{{ $permission->id }}"
                                                                       {{ in_array($permission->id, old('permissions', $selectedPermissions)) ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                       for="permission_{{ $permission->id }}">

                                                                    <span class="fw-semibold">
                                                                        {{ $permission->nome }}
                                                                    </span>

                                                                    @if($permission->descricao)

                                                                        <small class="text-muted d-block">
                                                                            {{ $permission->descricao }}
                                                                        </small>

                                                                    @endif

                                                                </label>

                                                            </div>

                                                        </div>

                                                    @endforeach

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- Rodapé --}}
                    <div class="card-footer bg-white py-3">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('perfis.index') }}"
                               class="btn btn-outline-secondary">

                                <i class="bi bi-x-circle me-1"></i>
                                Cancelar

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-check-circle me-1"></i>
                                Atualizar Perfil

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const selecionarTodas = document.getElementById('selecionarTodas');
    const limparTodas = document.getElementById('limparTodas');

    function getCheckboxes() {
        return document.querySelectorAll('.permission-checkbox');
    }

    if (selecionarTodas) {
        selecionarTodas.addEventListener('click', function () {

            getCheckboxes().forEach(function (checkbox) {
                checkbox.checked = true;
            });

        });
    }

    if (limparTodas) {
        limparTodas.addEventListener('click', function () {

            getCheckboxes().forEach(function (checkbox) {
                checkbox.checked = false;
            });

        });
    }

});
</script>
@endpush