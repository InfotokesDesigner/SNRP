@extends('layouts.snrp.app')

@section('title', 'Editar Tipo de Património - SNRP')

@section('page-title', 'Editar Tipo de Património')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title mb-0">
            Editar Tipo de Património
        </h3>

    </div>

    <form method="POST"
          action="{{ route('tipos-patrimonio.update', $tipoPatrimonio) }}">

        @csrf

        @method('PUT')

        <div class="card-body">

            {{-- Nome --}}
            <div class="mb-3">

                <label class="form-label">
                    Nome <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nome"
                    class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $tipoPatrimonio->nome) }}"
                    required
                >

                @error('nome')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Descrição --}}
            <div class="mb-3">

                <label class="form-label">
                    Descrição
                </label>

                <textarea
                    name="descricao"
                    rows="4"
                    class="form-control @error('descricao') is-invalid @enderror"
                >{{ old('descricao', $tipoPatrimonio->descricao) }}</textarea>

                @error('descricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Estado --}}
            <div class="form-check">

                <input
                    type="checkbox"
                    name="ativo"
                    value="1"
                    class="form-check-input"
                    id="ativo"
                    {{ old('ativo', $tipoPatrimonio->ativo) ? 'checked' : '' }}
                >

                <label class="form-check-label"
                       for="ativo">

                    Tipo de património ativo

                </label>

            </div>

        </div>


        <div class="card-footer d-flex justify-content-between">

            <a href="{{ route('tipos-patrimonio.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>

                Voltar

            </a>

            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-save me-1"></i>

                Atualizar

            </button>

        </div>

    </form>

</div>

@endsection