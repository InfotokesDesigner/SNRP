@extends('layouts.snrp.app')

@section('title', 'Editar Pessoa - SNRP')

@section('page-title', 'Editar Pessoa')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="bi bi-person-gear me-2"></i>
            Editar Pessoa
        </h3>
    </div>

    <form method="POST" action="{{ route('pessoas.update', $pessoa) }}">

        @csrf
        @method('PUT')

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">

                    <strong>Verifique os seguintes erros:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <div class="row g-3">

                <div class="col-md-4">

                    <label class="form-label">
                        Código do Cidadão
                    </label>

                    <input
                        type="text"
                        name="codigo_cidadao"
                        class="form-control"
                        value="{{ old('codigo_cidadao', $pessoa->codigo_cidadao) }}">

                </div>

                <div class="col-md-8">

                    <label class="form-label">
                        Nome completo <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nome_completo"
                        class="form-control"
                        value="{{ old('nome_completo', $pessoa->nome_completo) }}"
                        required>

                </div>

                <div class="col-md-4">

    <label class="form-label">
        Utilizador associado
    </label>

    <select name="user_id" class="form-select">

        <option value="">
            Nenhum utilizador associado
        </option>

        @foreach($utilizadores as $utilizador)

            <option
                value="{{ $utilizador->id }}"
                @selected(old('user_id', $pessoa->user_id) == $utilizador->id)
            >
                {{ $utilizador->name }} — {{ $utilizador->email }}
            </option>

        @endforeach

    </select>

    <small class="text-muted">
        Esta conta terá acesso aos recursos associados a esta Pessoa.
    </small>

</div>

                <div class="col-md-4">

                    <label class="form-label">BI</label>

                    <input
                        type="text"
                        name="bi"
                        class="form-control"
                        value="{{ old('bi', $pessoa->bi) }}">

                </div>

                <div class="col-md-4">

                    <label class="form-label">NIF</label>

                    <input
                        type="text"
                        name="nif"
                        class="form-control"
                        value="{{ old('nif', $pessoa->nif) }}">

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Data de nascimento
                    </label>

                    <input
                        type="date"
                        name="data_nascimento"
                        class="form-control"
                        value="{{ old('data_nascimento', $pessoa->data_nascimento) }}">

                </div>

                <div class="col-md-4">

                    <label class="form-label">Sexo</label>

                    <select name="sexo" class="form-select">

                        <option value="">Selecionar...</option>

                        <option value="Masculino"
                            @selected(old('sexo', $pessoa->sexo) === 'Masculino')}>
                            Masculino
                        </option>

                        <option value="Feminino"
                            @selected(old('sexo', $pessoa->sexo) === 'Feminino')}>
                            Feminino
                        </option>

                    </select>

                </div>

                <div class="col-md-4">

                    <label class="form-label">Telefone</label>

                    <input
                        type="text"
                        name="telefone"
                        class="form-control"
                        value="{{ old('telefone', $pessoa->telefone) }}">

                </div>

                <div class="col-md-4">

                    <label class="form-label">E-mail</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $pessoa->email) }}">

                </div>

                <div class="col-md-12">

                    <label class="form-label">Morada</label>

                    <textarea
                        name="morada"
                        class="form-control"
                        rows="3">{{ old('morada', $pessoa->morada) }}</textarea>

                </div>

                <div class="col-md-12">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="ativo"
                            value="1"
                            class="form-check-input"
                            id="ativo"
                            @checked(old('ativo', $pessoa->ativo))>

                        <label class="form-check-label" for="ativo">
                            Pessoa ativa
                        </label>

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">

            <a href="{{ route('pessoas.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Voltar

            </a>

            <button type="submit" class="btn btn-primary">

                <i class="bi bi-save me-1"></i>
                Atualizar Pessoa

            </button>

        </div>

    </form>

</div>

@endsection