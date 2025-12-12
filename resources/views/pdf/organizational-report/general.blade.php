<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title>Inventário de Riscos Psicossociais</title>

        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                color: #1f2937;
                margin: 20px 16px 30px 16px;
            }

            table {
                margin: 0 auto;
                width: 100%;
                border-collapse: collapse;
            }
            td,
            th {
                border: 1px solid #999;
                padding: 5px;
                vertical-align: center;
                font-size: 12px;
                color: #333;
            }
            th {
                background-color: #e0e0e0;
                color: #333;
            }

            p,
            h2 {
                margin: 2px;
            }

            .page-break {
                page-break-after: always;
            }

            .footer {
                position: fixed;
                left: 50%;
                bottom: 0px;
                transform: translateX(-50%);
                text-align: center;
            }

            .pagenum:before {
                content: counter(page);
            }
        </style>
    </head>

    <body>
        <x-pdf.cover>
            @if ($companyLogo)
                <img src="{{ $companyLogo }}" style="height: 90px; margin-bottom:24px;" alt="Logomarca" />
            @endif

            <h2 style="margin-bottom: 18px">{{ $company->name }}</h2>
            <h1 style="margin-bottom: 8px; font-size: 32px">Pesquisa de Clima Organizacional</h1>
            <p style="font-size: 16px">Relatório da Pesquisa de Clima Organizacional dividido por {{ App\Enums\OC\OCEvaluation::from($evaluation_type)->label() }}.</p>
        </x-pdf.cover>

        <div class="page-break"></div>

        <table style="margin-bottom: 12px;">
            <thead>
                <tr>
                    <th colspan="6" style="text-align: left;">Índice Geral de Satisfação por grupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dashboard['general-satisfaction-by-group']->chunk(3) as $chunk)
                    <tr>
                        @foreach ($chunk as $group => $satisfaction)
                            <td style="width: 28%; font-size: 10px">{{ App\Enums\OC\OCGroup::from($group)->label() }}</td>
                            <td style="width: 5.3%; font-size: 10px">{{ $satisfaction }}%</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($dashboard['division-factor-satisfaction-by-group']->chunk(2) as $chunk)
            <table width="100%" style="border: none;">
                <tr style="border: none;">
                    @foreach ($chunk as $group => $satisfactions)
                        <td style="width: 50%; vertical-align: top; border: none;">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: left;">{{ App\Enums\OC\OCGroup::from($group)->label() }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($satisfactions as $divisionFactor => $satisfaction)
                                        <tr>
                                            <td style="width: 90%; font-size: 10px">{{ $divisionFactor }}</td>
                                            <td style="width: 10%; font-size: 10px">{{ $satisfaction }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    @endforeach
                </tr>
            </table>
        @endforeach
        
        <x-pdf.footer />
    </body>
</html>
