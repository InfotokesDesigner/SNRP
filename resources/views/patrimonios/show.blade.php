@extends('layouts.snrp.app')

@section('title', 'Visualizar Património - SNRP')

@section('page-title', 'Visualizar Património')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            <i class="bi bi-house me-1"></i>
            Dados do Património
        </h3>

        <div>
<a href="{{ route('patrimonios.edit', $patrimonio) }}"
   class="btn btn-warning">

    <i class="bi bi-pencil me-1"></i>
    Editar

</a>

<a href="{{ route('patrimonios.certificado', $patrimonio) }}"
   class="btn btn-primary"
   target="_blank">

    <i class="bi bi-file-earmark-text me-1"></i>
    Certificado

</a>

<a href="{{ route('patrimonios.index') }}"
   class="btn btn-secondary">

    <i class="bi bi-arrow-left me-1"></i>
    Voltar

</a>

        </div>

    </div>


    <div class="card-body">

        <div class="row g-4">

            {{-- Código --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Código
                </label>

                <div>
                    <span class="badge text-bg-primary fs-6">
                        {{ $patrimonio->codigo }}
                    </span>
                </div>

            </div>


            {{-- Estado --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Estado
                </label>

                <div>

                    @if($patrimonio->estado === 'Ativo')

                        <span class="badge text-bg-success fs-6">
                            Ativo
                        </span>

                    @elseif($patrimonio->estado === 'Transferido')

                        <span class="badge text-bg-warning fs-6">
                            Transferido
                        </span>

                    @else

                        <span class="badge text-bg-secondary fs-6">
                            Inativo
                        </span>

                    @endif

                </div>

            </div>


            {{-- Tipo --}}
            <div class="col-md-4">

                <label class="form-label text-muted">
                    Tipo de Património
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->tipoPatrimonio->nome ?? '—' }}

                </div>

            </div>


            {{-- Nome --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Nome do Património
                </label>

                <div class="fs-5 fw-bold">

                    {{ $patrimonio->nome }}

                </div>

            </div>


            {{-- Proprietário --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Proprietário
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->pessoa->nome_completo ?? '—' }}

                </div>

                @if($patrimonio->pessoa?->codigo_cidadao)

                    <small class="text-muted">

                        Código do cidadão:
                        {{ $patrimonio->pessoa->codigo_cidadao }}

                    </small>

                @endif

            </div>


            {{-- Instituição --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Instituição responsável
                </label>

                <div class="fw-bold">

                    {{ $patrimonio->instituicao->nome ?? '—' }}

                </div>

                @if($patrimonio->instituicao?->sigla)

                    <small class="text-muted">

                        {{ $patrimonio->instituicao->sigla }}

                    </small>

                @endif

            </div>


            {{-- Localização --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Localização
                </label>

                <div>

                    @if($patrimonio->localizacao)

                        <i class="bi bi-geo-alt me-1"></i>

                        {{ $patrimonio->localizacao }}

                    @else

                        <span class="text-muted">
                            Não informada
                        </span>

                    @endif

                </div>

            </div>


            {{-- Coordenadas --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Latitude
                </label>

                <div>

                    {{ $patrimonio->latitude ?? '—' }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label text-muted">
                    Longitude
                </label>

                <div>

                    {{ $patrimonio->longitude ?? '—' }}

                </div>

            </div>


            {{-- Descrição --}}
            <div class="col-md-12">

                <label class="form-label text-muted">
                    Descrição
                </label>

                <div class="border rounded p-3 bg-light">

                    @if($patrimonio->descricao)

                        {!! nl2br(e($patrimonio->descricao)) !!}

                    @else

                        <span class="text-muted">
                            Nenhuma descrição informada.
                        </span>

                    @endif

                </div>

            </div>


            {{-- Datas --}}
            <div class="col-md-6">

                <label class="form-label text-muted">
                    Registado em
                </label>

                <div>

                    {{ $patrimonio->created_at?->format('d/m/Y H:i') ?? '—' }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label text-muted">
                    Última atualização
                </label>

                <div>

                    {{ $patrimonio->updated_at?->format('d/m/Y H:i') ?? '—' }}

                </div>

            </div>

        </div>

    </div>


    <div class="card-footer">

        <a href="{{ route('patrimonios.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Voltar para a lista

        </a>

    </div>

</div>
{{-- Histórico de Transferências --}}
<div class="card mt-4">

    <div class="card-header">

        <h5 class="mb-0">
            <i class="bi bi-clock-history me-1"></i>
            Histórico de Proprietários
        </h5>

    </div>

    <div class="card-body">

        @if($patrimonio->transferencias->count() > 0)

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Data</th>

                            <th>Proprietário anterior</th>

                            <th>Novo proprietário</th>

                            <th>Observação</th>

                            <th class="text-center">Ação</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($patrimonio->transferencias->sortByDesc('data_transferencia') as $transferencia)

                            <tr>

                                {{-- Data --}}
                                <td>

                                    {{ $transferencia->data_transferencia
                                        ? $transferencia->data_transferencia->format('d/m/Y')
                                        : '—'
                                    }}

                                </td>


                                {{-- Proprietário anterior --}}
                                <td>

                                    <strong>
                                        {{ $transferencia->proprietarioAnterior->nome_completo ?? '—' }}
                                    </strong>

                                    @if($transferencia->proprietarioAnterior?->codigo_cidadao)

                                        <br>

                                        <small class="text-muted">

                                            {{ $transferencia->proprietarioAnterior->codigo_cidadao }}

                                        </small>

                                    @endif

                                </td>


                                {{-- Novo proprietário --}}
                                <td>

                                    <strong>
                                        {{ $transferencia->novoProprietario->nome_completo ?? '—' }}
                                    </strong>

                                    @if($transferencia->novoProprietario?->codigo_cidadao)

                                        <br>

                                        <small class="text-muted">

                                            {{ $transferencia->novoProprietario->codigo_cidadao }}

                                        </small>

                                    @endif

                                </td>


                                {{-- Observação --}}
                                <td>

                                    @if($transferencia->observacao)

                                        {{ $transferencia->observacao }}

                                    @else

                                        <span class="text-muted">
                                            Sem observação
                                        </span>

                                    @endif

                                </td>


                                {{-- Ação --}}
                                <td class="text-center">

                                    <a href="{{ route(
                                        'transferencias-patrimoniais.show',
                                        $transferencia
                                    ) }}"
                                       class="btn btn-sm btn-primary">

                                        <i class="bi bi-eye me-1"></i>
                                        Ver

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center text-muted py-4">

                <i class="bi bi-clock-history fs-1 d-block mb-2"></i>

                <p class="mb-0">
                    Este património ainda não possui transferências registadas.
                </p>

            </div>

        @endif

    </div>

</div>



{{-- QR Code --}}
<div class="col-md-12 mt-4">

    <div class="card border">

        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-qr-code me-1"></i>
                QR Code do Património
            </h5>
        </div>

        <div class="card-body text-center">

            <div class="mb-3">
                {!! $qrCode !!}
            </div>

            <p class="text-muted mb-2">
                Aponte a câmara do telemóvel para consultar este património.
            </p>

            <small class="text-muted">
                Código: <strong>{{ $patrimonio->codigo }}</strong>
            </small>

        </div>

    </div>

</div>


        



   {{-- Fotografias do Património --}}
<div class="card mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-images me-1"></i>
            Fotografias do Património
        </h5>

        <span class="badge text-bg-secondary">
            {{ $patrimonio->fotografias->count() }}
        </span>

    </div>

    <div class="card-body">

        {{-- Formulário de upload --}}
        <form action="{{ route('patrimonios.fotografias.store', $patrimonio) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label for="fotografia" class="form-label">
                        Fotografia
                        <span class="text-danger">*</span>
                    </label>

                    <input type="file"
                           name="fotografia"
                           id="fotografia"
                           class="form-control @error('fotografia') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/webp"
                           required>

                    @error('fotografia')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                    <small class="text-muted">
                        JPG, PNG ou WEBP — máximo 5 MB.
                    </small>

                </div>


                <div class="col-md-4">

                    <label for="descricao" class="form-label">
                        Descrição
                    </label>

                    <input type="text"
                           name="descricao"
                           id="descricao"
                           class="form-control"
                           placeholder="Ex.: Fachada principal">

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <div class="form-check mb-2">

                        <input type="checkbox"
                               name="principal"
                               value="1"
                               id="principal"
                               class="form-check-input">

                        <label for="principal"
                               class="form-check-label">

                            Fotografia principal

                        </label>

                    </div>

                </div>

            </div>


            <div class="mt-3">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-upload me-1"></i>
                    Adicionar fotografia

                </button>

            </div>

        </form>


        {{-- Galeria --}}
        @if($patrimonio->fotografias->count())

            @php

                $fotografiaPrincipal = $patrimonio->fotografias
                    ->firstWhere('principal', true);

                $outrasFotografias = $patrimonio->fotografias
                    ->filter(fn ($fotografia) => !$fotografia->principal);

            @endphp


            {{-- Fotografia Principal --}}
            @if($fotografiaPrincipal)

                <div class="mb-5 mt-4">

                    <div class="d-flex align-items-center mb-3">

                        <h5 class="mb-0">

                            <i class="bi bi-star-fill text-warning me-2"></i>

                            Fotografia Principal

                        </h5>

                    </div>


                    <div class="card border-0 shadow-sm overflow-hidden">

                        <div class="position-relative">

                            <img src="{{ asset('storage/' . $fotografiaPrincipal->caminho) }}"
                                 class="img-fluid w-100"
                                 alt="{{ $fotografiaPrincipal->descricao ?? 'Fotografia principal do património' }}"
                                 style="height: 450px; object-fit: cover;">

                            <span class="position-absolute top-0 start-0 m-3 badge text-bg-primary fs-6">

                                <i class="bi bi-star-fill me-1"></i>

                                Principal

                            </span>

                        </div>


                        <div class="card-body">

                            @if($fotografiaPrincipal->descricao)

                                <h6 class="mb-1">
                                    {{ $fotografiaPrincipal->descricao }}
                                </h6>

                            @endif

                            <small class="text-muted">

                                Adicionada em
                                {{ $fotografiaPrincipal->created_at?->format('d/m/Y H:i') }}

                            </small>


                            <div class="mt-3">

                                <form action="{{ route(
                                    'patrimonios.fotografias.destroy',
                                    [$patrimonio, $fotografiaPrincipal]
                                ) }}"
                                method="POST"
                                onsubmit="return confirm('Tem certeza que deseja eliminar esta fotografia?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">

                                        <i class="bi bi-trash me-1"></i>

                                        Eliminar

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Outras Fotografias --}}
            @if($outrasFotografias->count())

                <div>

                    <h5 class="mb-3">

                        <i class="bi bi-images me-2"></i>

                        Outras Fotografias

                        <span class="badge text-bg-secondary ms-1">
                            {{ $outrasFotografias->count() }}
                        </span>

                    </h5>


                    <div class="row g-4">

                        @foreach($outrasFotografias as $fotografia)

                            <div class="col-md-4 col-lg-3">

                                <div class="card h-100 shadow-sm">

                                    <img src="{{ asset('storage/' . $fotografia->caminho) }}"
                                         class="card-img-top"
                                         alt="{{ $fotografia->descricao ?? 'Fotografia do património' }}"
                                         style="height: 200px; object-fit: cover;">


                                    <div class="card-body">

                                        @if($fotografia->descricao)

                                            <p class="mb-2">
                                                {{ $fotografia->descricao }}
                                            </p>

                                        @endif


                                        <small class="text-muted d-block mb-3">

                                            {{ $fotografia->created_at?->format('d/m/Y H:i') }}

                                        </small>


                                        <div class="d-flex gap-2 flex-wrap">

                                            {{-- Definir como principal --}}
                                            <form action="{{ route(
                                                'patrimonios.fotografias.principal',
                                                [$patrimonio, $fotografia]
                                            ) }}"
                                            method="POST">

                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-primary">

                                                    <i class="bi bi-star me-1"></i>

                                                    Definir como principal

                                                </button>

                                            </form>


                                            {{-- Eliminar --}}
                                            <form action="{{ route(
                                                'patrimonios.fotografias.destroy',
                                                [$patrimonio, $fotografia]
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja eliminar esta fotografia?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">

                                                    <i class="bi bi-trash me-1"></i>

                                                    Eliminar

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


        @else

            <div class="alert alert-light border mt-4 mb-0">

                <i class="bi bi-info-circle me-1"></i>

                Ainda não existem fotografias registadas para este património.

            </div>

        @endif

    </div>

</div>

@endsection