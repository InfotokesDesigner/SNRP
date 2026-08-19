@extends('layouts.snrp.app')

@section('title', 'Novo Património - SNRP')

@section('page-title', 'Novo Património')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title mb-0">
            <i class="bi bi-house-add me-1"></i>
            Cadastrar Novo Património
        </h3>

    </div>

    <form method="POST" action="{{ route('patrimonios.store') }}">

        @csrf

        <div class="card-body">

            {{-- Erros de validação --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Verifique os seguintes erros:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $erro)

                            <li>{{ $erro }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="row g-3">

             {{-- Tipo --}}
                <div class="col-md-4">

                    <label for="tipo_patrimonio_id" class="form-label">
                        Tipo de Património *
                    </label>

                    <select
                        id="tipo_patrimonio_id"
                        name="tipo_patrimonio_id"
                        class="form-select @error('tipo_patrimonio_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            -- Selecionar tipo --
                        </option>

                        @foreach($tipos as $tipo)

                            <option
                                value="{{ $tipo->id }}"
                                {{ old('tipo_patrimonio_id') == $tipo->id ? 'selected' : '' }}
                            >
                                {{ $tipo->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('tipo_patrimonio_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Estado --}}
                <div class="col-md-4">

                    <label for="estado" class="form-label">
                        Estado *
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="form-select @error('estado') is-invalid @enderror"
                        required
                    >

                        <option value="Ativo"
                            {{ old('estado', 'Ativo') == 'Ativo' ? 'selected' : '' }}>
                            Ativo
                        </option>

                        <option value="Transferido"
                            {{ old('estado') == 'Transferido' ? 'selected' : '' }}>
                            Transferido
                        </option>

                        <option value="Inativo"
                            {{ old('estado') == 'Inativo' ? 'selected' : '' }}>
                            Inativo
                        </option>

                    </select>

                    @error('estado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Nome --}}
                <div class="col-md-12">

                    <label for="nome" class="form-label">
                        Nome do Património *
                    </label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome') }}"
                        placeholder="Ex.: Residência do Bairro Tal"
                        required
                    >

                    @error('nome')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Proprietário --}}
                <div class="col-md-6">

                    <label for="pessoa_id" class="form-label">
                        Proprietário *
                    </label>

                    <select
                        id="pessoa_id"
                        name="pessoa_id"
                        class="form-select @error('pessoa_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            -- Selecionar proprietário --
                        </option>

                        @foreach($pessoas as $pessoa)

                            <option
                                value="{{ $pessoa->id }}"
                                {{ old('pessoa_id') == $pessoa->id ? 'selected' : '' }}
                            >

                                {{ $pessoa->nome_completo }}

                                @if($pessoa->codigo_cidadao)
                                    — {{ $pessoa->codigo_cidadao }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('pessoa_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Instituição --}}
                <div class="col-md-6">

                    <label for="instituicao_id" class="form-label">
                        Instituição *
                    </label>

                    <select
                        id="instituicao_id"
                        name="instituicao_id"
                        class="form-select @error('instituicao_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            -- Selecionar instituição --
                        </option>

                        @foreach($instituicoes as $instituicao)

                            <option
                                value="{{ $instituicao->id }}"
                                {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}
                            >

                                {{ $instituicao->nome }}

                                @if($instituicao->sigla)
                                    — {{ $instituicao->sigla }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('instituicao_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Localização --}}
                <div class="col-md-12">

                    <label for="localizacao" class="form-label">
                        Localização
                    </label>

                    <textarea
                        id="localizacao"
                        name="localizacao"
                        rows="2"
                        class="form-control @error('localizacao') is-invalid @enderror"
                        placeholder="Ex.: Luanda, Viana, Bairro..."
                    >{{ old('localizacao') }}</textarea>

                    @error('localizacao')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Latitude --}}
                <div class="col-md-6">

                    <label for="latitude" class="form-label">
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="latitude"
                        name="latitude"
                        class="form-control @error('latitude') is-invalid @enderror"
                        value="{{ old('latitude') }}"
                        placeholder="Ex.: -8.83999"
                    >

                    @error('latitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Longitude --}}
                <div class="col-md-6">

                    <label for="longitude" class="form-label">
                        Longitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="longitude"
                        name="longitude"
                        class="form-control @error('longitude') is-invalid @enderror"
                        value="{{ old('longitude') }}"
                        placeholder="Ex.: 13.28944"
                    >

                    @error('longitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Descrição --}}
                <div class="col-md-12">

                    <label for="descricao" class="form-label">
                        Descrição
                    </label>

                    <textarea
                        id="descricao"
                        name="descricao"
                        rows="4"
                        class="form-control @error('descricao') is-invalid @enderror"
                        placeholder="Descrição detalhada do património..."
                    >{{ old('descricao') }}</textarea>

                    @error('descricao')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Botões --}}
        <div class="card-footer d-flex justify-content-between">

            <a
                href="{{ route('patrimonios.index') }}"
                class="btn btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Voltar

            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="bi bi-save me-1"></i>

                Cadastrar Património

            </button>

        </div>

    </form>

</div>

@endsection