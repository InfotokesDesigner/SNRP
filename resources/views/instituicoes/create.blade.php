@extends('layouts.snrp.app')

@section('title', 'Nova Instituição - SNRP')

@section('page-title', 'Nova Instituição')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-building-add me-2"></i>
            Cadastrar Instituição
        </h3>
    </div>

    <form method="POST" action="{{ route('instituicoes.store') }}">

        @csrf

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Existem erros no formulário:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="row">

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Nome da Instituição *
                    </label>

                    <input type="text"
                           name="nome"
                           class="form-control"
                           value="{{ old('nome') }}"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Sigla *
                    </label>

                    <input type="text"
                           name="sigla"
                           class="form-control"
                           value="{{ old('sigla') }}"
                           maxlength="20"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        NIF
                    </label>

                    <input type="text"
                           name="nif"
                           class="form-control"
                           value="{{ old('nif') }}">

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Telefone
                    </label>

                    <input type="text"
                           name="telefone"
                           class="form-control"
                           value="{{ old('telefone') }}">

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        E-mail
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}">

                </div>


                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Endereço
                    </label>

                    <textarea name="endereco"
                              class="form-control"
                              rows="3">{{ old('endereco') }}</textarea>

                </div>


                <div class="col-md-12 mb-3">

                    <div class="form-check">

                        <input type="checkbox"
                               name="ativo"
                               value="1"
                               class="form-check-input"
                               id="ativo"
                               checked>

                        <label class="form-check-label"
                               for="ativo">

                            Instituição ativa

                        </label>

                    </div>

                </div>

            </div>

        </div>


        <div class="card-footer d-flex justify-content-between">

            <a href="{{ route('instituicoes.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Voltar

            </a>


            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-lg me-1"></i>
                Cadastrar Instituição

            </button>

        </div>

    </form>

</div>

@endsection