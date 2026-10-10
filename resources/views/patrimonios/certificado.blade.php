@extends('layouts.snrp.app')

@section('title', 'Certificado Patrimonial')

@section('content')

<style>
    :root {
        --snrp-blue: #0b5ed7;
        --snrp-dark: #0b2d4d;
        --snrp-orange: #f59e0b;
        --snrp-light: #eef6ff;
        --snrp-border: #cbdbea;
        --snrp-text: #243447;
        --snrp-muted: #6b7c8f;
    }

    .certificado-wrapper {
        padding: 20px;
    }

    .certificado-actions {
        margin-bottom: 15px;
    }

    .certificado-page {
        position: relative;
        width: 100%;
        max-width: 900px;
        min-height: 1100px;
        margin: 0 auto;
        padding: 28px;
        background: #ffffff;
        border: 2px solid var(--snrp-blue);
        box-shadow: 0 8px 30px rgba(11, 45, 77, 0.12);
        overflow: hidden;
        color: var(--snrp-text);
    }

    /* Marca d'água */
    .certificado-page::before {
        content: "SNRP";
        position: absolute;
        z-index: 0;
        top: 43%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-18deg);
        font-size: 170px;
        font-weight: 900;
        letter-spacing: 15px;
        color: rgba(11, 94, 215, 0.035);
        pointer-events: none;
        white-space: nowrap;
    }

    .certificado-content {
        position: relative;
        z-index: 2;
    }

    /* Barra superior */
    .certificado-top-bar {
        height: 7px;
        margin: -28px -28px 25px -28px;
        background: linear-gradient(
            90deg,
            var(--snrp-blue) 0%,
            var(--snrp-blue) 72%,
            var(--snrp-orange) 72%,
            var(--snrp-orange) 100%
        );
    }

    /* Cabeçalho */
    .certificado-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid var(--snrp-border);
        padding-bottom: 18px;
    }

    .brand-area {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .brand-mark {
        width: 62px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--snrp-blue);
        color: white;
        font-size: 20px;
        font-weight: 900;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(11, 94, 215, 0.22);
        border-bottom: 5px solid var(--snrp-orange);
    }

    .brand-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--snrp-dark);
        margin: 0;
    }

    .brand-subtitle {
        font-size: 12px;
        color: var(--snrp-muted);
        margin: 3px 0 0;
    }

    .certificate-meta {
        text-align: right;
    }

    .certificate-label {
        font-size: 10px;
        color: var(--snrp-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .certificate-number {
        font-size: 15px;
        font-weight: 800;
        color: var(--snrp-blue);
        margin: 2px 0 5px;
    }

    .certificate-date {
        font-size: 11px;
        color: var(--snrp-muted);
    }

    /* Título */
    .certificate-title {
        text-align: center;
        margin: 28px 0 20px;
    }

    .certificate-title h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 900;
        color: var(--snrp-dark);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .certificate-title .line {
        width: 80px;
        height: 4px;
        background: var(--snrp-orange);
        margin: 9px auto 10px;
        border-radius: 5px;
    }

    .certificate-title p {
        margin: 0;
        color: var(--snrp-muted);
        font-size: 12px;
    }

    /* Código */
    .codigo-box {
        display: flex;
        justify-content: center;
        margin-bottom: 22px;
    }

    .codigo {
        display: inline-block;
        padding: 8px 22px;
        border: 1px solid #b9d2ef;
        background: var(--snrp-light);
        color: var(--snrp-blue);
        border-radius: 20px;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* Secções */
    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 18px 0 9px;
        font-size: 12px;
        font-weight: 800;
        color: var(--snrp-dark);
        text-transform: uppercase;
        letter-spacing: .7px;
    }

    .section-title::before {
        content: "";
        width: 4px;
        height: 17px;
        background: var(--snrp-orange);
        border-radius: 4px;
    }

    /* Tabela */
    .dados-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
        background: rgba(255,255,255,.95);
    }

    .dados-table td {
        border: 1px solid var(--snrp-border);
        padding: 9px 11px;
        vertical-align: top;
    }

    .dados-table .label {
        width: 17%;
        background: var(--snrp-light);
        color: var(--snrp-dark);
        font-weight: 800;
        white-space: nowrap;
    }

    .dados-table .value {
        width: 33%;
        color: var(--snrp-text);
    }

    .dados-table .description {
        min-height: 45px;
    }

    /* Proprietário */
    .owner-box {
        border: 1px solid var(--snrp-border);
        background: rgba(255,255,255,.96);
    }

    .owner-name {
        padding: 12px 14px;
        background: var(--snrp-light);
        border-bottom: 1px solid var(--snrp-border);
        color: var(--snrp-dark);
        font-size: 16px;
        font-weight: 800;
    }

    .owner-details {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .owner-detail {
        padding: 9px 12px;
        border-right: 1px solid var(--snrp-border);
    }

    .owner-detail:last-child {
        border-right: none;
    }

    .owner-detail small {
        display: block;
        font-size: 9px;
        color: var(--snrp-muted);
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .owner-detail strong {
        font-size: 11px;
        color: var(--snrp-text);
    }

    /* Rodapé certificado */
    .certificate-bottom {
        display: grid;
        grid-template-columns: 1fr 150px;
        gap: 25px;
        align-items: end;
        margin-top: 25px;
    }

    .declaration {
        font-size: 10px;
        line-height: 1.55;
        color: var(--snrp-muted);
        text-align: justify;
    }

    .signature {
        text-align: center;
    }

    .signature-line {
        border-top: 1px solid var(--snrp-dark);
        margin-top: 38px;
        padding-top: 6px;
        font-size: 10px;
        color: var(--snrp-dark);
        font-weight: 700;
    }

    /* QR */
    .qr-area {
        display: flex;
        justify-content: center;
        margin-top: 18px;
    }

    .qr-box {
        width: 115px;
        padding: 7px;
        border: 1px solid var(--snrp-border);
        background: #fff;
        text-align: center;
    }

    .qr-box img {
        width: 95px;
        height: 95px;
        object-fit: contain;
    }

    .qr-box small {
        display: block;
        margin-top: 4px;
        font-size: 8px;
        color: var(--snrp-muted);
    }

    /* Rodapé */
    .certificate-footer {
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid var(--snrp-border);
        display: flex;
        justify-content: space-between;
        gap: 20px;
        font-size: 8px;
        color: var(--snrp-muted);
    }

    .certificate-footer strong {
        color: var(--snrp-blue);
    }

    /* IMPRESSÃO A4 */
   
    /* IMPRESSÃO DO CERTIFICADO EM A4 */
    @media print {
        @page {
            size: A4 portrait;
            margin: 7mm;
        }

        html,
        body {
            width: 100% !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
            overflow: visible !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Ocultar toda a interface do SNRP */
        body * {
            visibility: hidden !important;
        }

        /* Mostrar somente o certificado */
        .certificado-page,
        .certificado-page * {
            visibility: visible !important;
        }

        .certificado-actions,
        .app-sidebar,
        .app-header,
        .app-footer,
        .app-content-header,
        .navbar,
        nav,
        .btn {
            display: none !important;
        }

        .certificado-wrapper {
            position: static !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .certificado-page {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 196mm !important;
            min-height: 0 !important;
            height: auto !important;
            max-height: none !important;
            margin: 0 !important;
            padding: 8mm !important;
            box-sizing: border-box !important;
            background: #ffffff !important;
            border: 1.5px solid var(--snrp-blue) !important;
            box-shadow: none !important;
            overflow: visible !important;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .certificado-content {
            position: relative !important;
            z-index: 2 !important;
        }

        .certificado-top-bar {
            margin: -8mm -8mm 6mm -8mm !important;
            height: 2.5mm !important;
        }

        .certificado-header {
            padding-bottom: 4mm !important;
            gap: 4mm !important;
        }

        .brand-mark {
            width: 14mm !important;
            height: 14mm !important;
            font-size: 14px !important;
        }

        .brand-title {
            font-size: 16px !important;
        }

        .brand-subtitle {
            font-size: 13px !important;
        }

        .certificate-label {
            font-size: 13px !important;
        }

        .certificate-number {
            font-size: 12px !important;
        }

        .certificate-date {
            font-size: 13px !important;
        }

        .certificate-title {
            margin: 5mm 0 4mm !important;
        }

        .certificate-title h1 {
            font-size: 21px !important;
        }

        .certificate-title p {
            font-size: 13px !important;
        }

        .codigo-box {
            margin-bottom: 4mm !important;
        }

        .codigo {
            padding: 2mm 6mm !important;
            font-size: 14px !important;
        }

        .section-title {
            margin: 3.5mm 0 2mm !important;
            font-size: 13px !important;
        }

        .dados-table {
            width: 100% !important;
            font-size: 10px !important;
        }

        .dados-table td {
            padding: 2.2mm 2mm !important;
            font-size: 13px !important;
            overflow-wrap: anywhere !important;
        }

        .dados-table .label {
            white-space: normal !important;
        }

        .owner-name {
            padding: 3mm !important;
            font-size: 13px !important;
        }

        .owner-detail {
            padding: 2.5mm !important;
            overflow-wrap: anywhere !important;
        }

        .owner-detail small {
            font-size: 10px !important;
        }

        .owner-detail strong {
            font-size: 13px !important;
            overflow-wrap: anywhere !important;
        }

        .certificate-bottom {
            margin-top: 5mm !important;
            gap: 5mm !important;
        }

        .declaration {
            font-size: 13px !important;
            line-height: 1.5 !important;
        }

        .signature-line {
            margin-top: 12mm !important;
            font-size: 13px !important;
        }

        .qr-area {
            margin-top: 3mm !important;
        }

        .qr-box {
            width: 25mm !important;
            padding: 1.5mm !important;
        }

        .qr-box img {
            width: 21mm !important;
            height: 21mm !important;
        }

        .qr-box small {
            font-size: 10px !important;
        }

        .certificate-footer {
            margin-top: 4mm !important;
            padding-top: 2mm !important;
            font-size:10px !important;
            gap: 2mm !important;
        }
    }

</style>

<div class="certificado-wrapper">

    {{-- BOTÕES --}}
    <div class="certificado-actions d-flex justify-content-between align-items-center">

        <a href="{{ url()->previous() }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>

        <button type="button"
                onclick="window.print()"
                class="btn btn-primary">
            <i class="bi bi-printer"></i>
            Imprimir Certificado
        </button>

    </div>


    {{-- CERTIFICADO --}}
    <div class="certificado-page">

        <div class="certificado-content">

            <div class="certificado-top-bar"></div>


            {{-- CABEÇALHO --}}
            <div class="certificado-header">

                <div class="brand-area">

                    <div class="brand-mark">
                        SNRP
                    </div>

                    <div>
                        <h2 class="brand-title">
                            Sistema de Registo Patrimonial
                        </h2>

                        <p class="brand-subtitle">
                            Gestão e controlo do património registado
                        </p>
                    </div>

                </div>


                <div class="certificate-meta">

                    <div class="certificate-label">
                        Certificado Nº
                    </div>

                    <div class="certificate-number">
                        CERT-SNRP-{{ str_pad($patrimonio->id, 6, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="certificate-date">
                        Emitido em {{ now()->format('d/m/Y H:i') }}
                    </div>

                </div>

            </div>


            {{-- TÍTULO --}}
            <div class="certificate-title">

                <h1>
                    Certificado Patrimonial
                </h1>

                <div class="line"></div>

                <p>
                    Documento de identificação e registo do património
                </p>

            </div>


            {{-- CÓDIGO --}}
            <div class="codigo-box">

                <div class="codigo">
                    {{ $patrimonio->codigo }}
                </div>

            </div>


            {{-- DADOS DO PATRIMÓNIO --}}
            <div class="section-title">
                Dados do Património
            </div>

            <table class="dados-table">

                <tr>

                    <td class="label">
                        Código
                    </td>

                    <td class="value">
                        {{ $patrimonio->codigo }}
                    </td>

                    <td class="label">
                        Tipo
                    </td>

                    <td class="value">
                        {{ $patrimonio->tipoPatrimonio?->nome ?? '—' }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Nome
                    </td>

                    <td class="value">
                        {{ $patrimonio->nome ?? '—' }}
                    </td>

                    <td class="label">
                        Estado
                    </td>

                    <td class="value">
                        {{ $patrimonio->estado ?? '—' }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Localização
                    </td>

                    <td class="value">
                        {{ $patrimonio->localizacao ?? '—' }}
                    </td>

                    <td class="label">
                        Instituição
                    </td>

                    <td class="value">
                        {{ $patrimonio->instituicao?->nome ?? '—' }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Registado em
                    </td>

                    <td class="value">
                        {{ $patrimonio->created_at?->format('d/m/Y') ?? '—' }}
                    </td>

                    <td class="label">
                        ID interno
                    </td>

                    <td class="value">
                        #{{ $patrimonio->id }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Descrição
                    </td>

                    <td colspan="3" class="value description">
                        {{ $patrimonio->descricao ?? 'Sem descrição registada.' }}
                    </td>

                </tr>

            </table>


            {{-- PROPRIETÁRIO --}}
            <div class="section-title">
                Proprietário Atual
            </div>

            <div class="owner-box">

                <div class="owner-name">

                    {{ $patrimonio->pessoa?->nome_completo ?? 'Não definido' }}

                </div>


                <div class="owner-details">

                    <div class="owner-detail">

                        <small>
                            Código do Cidadão
                        </small>

                        <strong>
                            {{ $patrimonio->pessoa?->codigo_cidadao ?? '—' }}
                        </strong>

                    </div>


                    <div class="owner-detail">

                        <small>
                            NIF
                        </small>

                        <strong>
                            {{ $patrimonio->pessoa?->nif ?? '—' }}
                        </strong>

                    </div>


                    <div class="owner-detail">

                        <small>
                            Bilhete de Identidade
                        </small>

                        <strong>
                            {{ $patrimonio->pessoa?->bi ?? '—' }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- QR / DECLARAÇÃO / ASSINATURA --}}
            <div class="certificate-bottom">

                <div>

                    <div class="declaration">

                        Declara-se que o património identificado neste certificado
                        encontra-se registado no Sistema de Registo Patrimonial
                        (SNRP), associado ao proprietário acima indicado, de acordo
                        com os dados existentes no sistema na data de emissão.

                    </div>


                    <div class="signature">

                        <div class="signature-line">
                            Responsável pelo Registo Patrimonial
                        </div>

                    </div>

                </div>


                @if($patrimonio->qr_code)

                    <div class="qr-area">

                        <div class="qr-box">

                            <img src="{{ asset($patrimonio->qr_code) }}"
                                 alt="QR Code">

                            <small>
                                Consulta pública
                            </small>

                        </div>

                    </div>

                @endif

            </div>


            {{-- RODAPÉ --}}
            <div class="certificate-footer">

                <div>
                    <strong>SNRP</strong>
                    — Sistema de Registo Patrimonial
                </div>

                <div>
                    Documento gerado eletronicamente
                </div>

                <div>
                    Código: {{ $patrimonio->codigo }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection