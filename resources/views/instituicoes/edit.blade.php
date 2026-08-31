@extends('layouts.snrp.app')

@section('title', 'Editar Instituição')
@section('page-title', 'Editar Instituição')

@section('content')

<div class="container-fluid">


{{-- CABEÇALHO --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="h3 mb-1">
            <i class="bi bi-building-gear text-primary me-2"></i>
            Editar Instituição
        </h1>

        <p class="text-muted mb-0">
            Atualize os dados da instituição.
        </p>
    </div>

    <a href="{{ route('instituicoes.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Voltar

    </a>

</div>


{{-- ERROS DE VALIDAÇÃO --}}
@if($errors->any())

    <div class="alert alert-danger alert-dismissible fade show">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Existem erros no formulário:
        </div>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif


{{-- FORMULÁRIO --}}
<form method="POST"
      action="{{ route('instituicoes.update', $instituicao) }}">

    @csrf
    @method('PUT')


    {{-- DADOS DA INSTITUIÇÃO --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-building me-2"></i>
                Dados da Instituição
            </h5>

        </div>


        <div class="card-body">

            <div class="row g-3">

                {{-- NOME --}}
                <div class="col-md-6">

                    <label for="nome" class="form-label">
                        Nome da instituição
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-building"></i>
                        </span>

                        <input type="text"
                               id="nome"
                               name="nome"
                               class="form-control @error('nome') is-invalid @enderror"
                               value="{{ old('nome', $instituicao->nome) }}"
                               required>

                    </div>

                    @error('nome')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- SIGLA --}}
                <div class="col-md-6">

                    <label for="sigla" class="form-label">
                        Sigla
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-tag"></i>
                        </span>

                        <input type="text"
                               id="sigla"
                               name="sigla"
                               class="form-control @error('sigla') is-invalid @enderror"
                               value="{{ old('sigla', $instituicao->sigla) }}"
                               required>

                    </div>

                    @error('sigla')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- NIF --}}
                <div class="col-md-6">

                    <label for="nif" class="form-label">
                        NIF
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-card-text"></i>
                        </span>

                        <input type="text"
                               id="nif"
                               name="nif"
                               class="form-control @error('nif') is-invalid @enderror"
                               value="{{ old('nif', $instituicao->nif) }}">

                    </div>

                    @error('nif')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- TELEFONE --}}
                <div class="col-md-6">

                    <label for="telefone" class="form-label">
                        Telefone
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-telephone"></i>
                        </span>

                        <input type="text"
                               id="telefone"
                               name="telefone"
                               class="form-control @error('telefone') is-invalid @enderror"
                               value="{{ old('telefone', $instituicao->telefone) }}">

                    </div>

                    @error('telefone')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div class="col-md-6">

                    <label for="email" class="form-label">
                        E-mail
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $instituicao->email) }}">

                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- LOGO --}}
                <div class="col-md-6">

                    <label for="logo" class="form-label">
                        Logo
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-image"></i>
                        </span>

                        <input type="text"
                               id="logo"
                               name="logo"
                               class="form-control @error('logo') is-invalid @enderror"
                               value="{{ old('logo', $instituicao->logo) }}"
                               placeholder="Caminho ou referência da logo">

                    </div>

                    @error('logo')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ENDEREÇO --}}
                <div class="col-12">

                    <label for="endereco" class="form-label">
                        Endereço
                    </label>

                    <textarea id="endereco"
                              name="endereco"
                              rows="3"
                              class="form-control @error('endereco') is-invalid @enderror"
                              placeholder="Endereço da instituição">{{ old('endereco', $instituicao->endereco) }}</textarea>

                    @error('endereco')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- ESTADO --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-toggle-on me-2"></i>
                Estado da Instituição
            </h5>

        </div>


        <div class="card-body">

            <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       role="switch"
                       id="ativo"
                       name="ativo"
                       value="1"
                       {{ old('ativo', $instituicao->ativo) ? 'checked' : '' }}>

                <label class="form-check-label" for="ativo">

                    <strong>Instituição ativa</strong>

                    <div class="text-muted small">
                        A instituição estará disponível para utilização no sistema.
                    </div>

                </label>

            </div>

        </div>

    </div>


    {{-- BOTÕES --}}
    <div class="d-flex justify-content-end gap-2 mb-4">

        <a href="{{ route('instituicoes.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-x-circle me-1"></i>
            Cancelar

        </a>


        <button type="submit"
                class="btn btn-primary">

            <i class="bi bi-check-circle me-1"></i>
            Guardar Alterações

        </button>

    </div>

</form>


</div>

@endsection
