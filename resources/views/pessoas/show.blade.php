@extends('layouts.snrp.app')

@section('title', 'Ficha da Pessoa - SNRP')

@section('page-title', 'Ficha da Pessoa')

@section('content')

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <h3 class="card-title mb-0">
                    <i class="bi bi-person-vcard me-2"></i>
                    Dados do Cidadão
                </h3>

                <span>
                    @if($pessoa->ativo)
                        <span class="badge text-bg-success">
                            Ativo
                        </span>
                    @else
                        <span class="badge text-bg-secondary">
                            Inativo
                        </span>
                    @endif
                </span>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <strong>Código do Cidadão</strong>
                        <div>
                            {{ $pessoa->codigo_cidadao ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Nome completo</strong>
                        <div>
                            {{ $pessoa->nome_completo }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>BI</strong>
                        <div>
                            {{ $pessoa->bi ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>NIF</strong>
                        <div>
                            {{ $pessoa->nif ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Data de nascimento</strong>
                        <div>
                            {{ $pessoa->data_nascimento
                                ? \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y')
                                : '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Sexo</strong>
                        <div>
                            {{ $pessoa->sexo ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Telefone</strong>
                        <div>
                            {{ $pessoa->telefone ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>E-mail</strong>
                        <div>
                            {{ $pessoa->email ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <strong>Morada</strong>
                        <div>
                            {{ $pessoa->morada ?? '—' }}
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">

                <a href="{{ route('pessoas.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>
                    Voltar

                </a>

                <a href="{{ route('pessoas.edit', $pessoa) }}"
                   class="btn btn-warning">

                    <i class="bi bi-pencil me-1"></i>
                    Editar

                </a>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Património do Cidadão
                </h3>

            </div>

            <div class="card-body">

                @if($pessoa->patrimonios->count())

                    <div class="list-group">

                        @foreach($pessoa->patrimonios as $patrimonio)

                            <a href="{{ route('patrimonios.show', $patrimonio) }}"
                               class="list-group-item list-group-item-action">

                                <strong>
                                    {{ $patrimonio->nome }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $patrimonio->codigo }}
                                </small>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="text-center text-muted py-3">

                        <i class="bi bi-house fs-1"></i>

                        <p class="mb-0 mt-2">
                            Nenhum património associado.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection