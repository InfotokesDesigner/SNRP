@extends('layouts.snrp.app')

@section('title', 'Novo Utilizador')
@section('page-title', 'Novo Utilizador')

@section('content')

<div class="container-fluid">

{{-- CABEÇALHO --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="h3 mb-1">
            <i class="bi bi-person-plus-fill text-primary me-2"></i>
            Novo Utilizador
        </h1>

        <p class="text-muted mb-0">
            Cadastre um novo utilizador e defina o seu perfil de acesso.
        </p>
    </div>

    <a href="{{ route('utilizadores.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Voltar

    </a>

</div>


{{-- ERROS DE VALIDAÇÃO --}}
@if($errors->any())

    <div class="alert alert-danger">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Existem erros no formulário:
        </div>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- FORMULÁRIO --}}
<form method="POST" action="{{ route('utilizadores.store') }}">

    @csrf

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-person-vcard me-2"></i>
                Dados do Utilizador
            </h5>

        </div>


        <div class="card-body">

            <div class="row g-3">

                {{-- NOME --}}
                <div class="col-md-6">

                    <label for="name" class="form-label">
                        Nome completo
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Nome completo"
                               required>

                    </div>

                    @error('name')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div class="col-md-6">

                    <label for="email" class="form-label">
                        E-mail
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="exemplo@dominio.com"
                               required>

                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PERFIL --}}
                <div class="col-md-6">

                    <label for="role_id" class="form-label">
                        Perfil de acesso
                        <span class="text-danger">*</span>
                    </label>

                    <select id="role_id"
                            name="role_id"
                            class="form-select @error('role_id') is-invalid @enderror"
                            required>

                        <option value="">
                            -- Seleccione o perfil --
                        </option>

                        @foreach($roles as $role)

                            <option value="{{ $role->id }}"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}>

                                {{ $role->nome }}

                            </option>

                        @endforeach

                    </select>

                    @error('role_id')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- INSTITUIÇÃO --}}
                <div class="col-md-6">

                    <label for="instituicao_id" class="form-label">
                        Instituição
                    </label>

                    <select id="instituicao_id"
                            name="instituicao_id"
                            class="form-select @error('instituicao_id') is-invalid @enderror">

                        <option value="">
                            -- Seleccione a instituição --
                        </option>

                        @foreach($instituicoes as $instituicao)

                            <option value="{{ $instituicao->id }}"
                                {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}>

                                {{ $instituicao->nome }}

                            </option>

                        @endforeach

                    </select>

                    @error('instituicao_id')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- SEGURANÇA --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-shield-lock-fill me-2"></i>
                Segurança
            </h5>

        </div>


        <div class="card-body">

            <div class="row g-3">

                {{-- PASSWORD --}}
                <div class="col-md-6">

                    <label for="password" class="form-label">
                        Palavra-passe
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                    </div>

                    @error('password')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CONFIRMAÇÃO --}}
                <div class="col-md-6">

                    <label for="password_confirmation" class="form-label">
                        Confirmar palavra-passe
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>

                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="form-control"
                               required>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ESTADO --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-toggle-on me-2"></i>
                Estado da Conta
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
                       checked>

                <label class="form-check-label" for="ativo">

                    <strong>Utilizador activo</strong>

                    <div class="text-muted small">
                        O utilizador poderá entrar no sistema.
                    </div>

                </label>

            </div>

        </div>

    </div>


    {{-- BOTÕES --}}
    <div class="d-flex justify-content-end gap-2 mb-4">

        <a href="{{ route('utilizadores.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-x-circle me-1"></i>
            Cancelar

        </a>


        <button type="submit"
                class="btn btn-primary">

            <i class="bi bi-check-circle me-1"></i>
            Criar Utilizador

        </button>

    </div>

</form>


</div>

@endsection
