@extends('layouts.snrp.app')

@section('title', 'Novo Tipo de Património - SNRP')

@section('page-title', 'Novo Tipo de Património')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title mb-0">
            Cadastrar Tipo de Património
        </h3>
    </div>

    <form method="POST" action="{{ route('tipos-patrimonio.store') }}">

        @csrf

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

            <div class="mb-3">

                <label class="form-label">
                    Nome <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nome"
                    class="form-control"
                    value="{{ old('nome') }}"
                    placeholder="Ex.: Terreno, Casa, Veículo..."
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Descrição
                </label>

                <textarea
                    name="descricao"
                    class="form-control"
                    rows="4"
                    placeholder="Descrição do tipo de património..."
                >{{ old('descricao') }}</textarea>

            </div>

            <div class="form-check">

                <input
                    type="checkbox"
                    name="ativo"
                    value="1"
                    class="form-check-input"
                    id="ativo"
                    checked
                >

                <label class="form-check-label" for="ativo">
                    Tipo ativo
                </label>

            </div>

        </div>

        <div class="card-footer">

            <a href="{{ route('tipos-patrimonio.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Voltar

            </a>

            <button type="submit" class="btn btn-primary">

                <i class="bi bi-check-circle me-1"></i>
                Guardar

            </button>

        </div>

    </form>

</div>

@endsection