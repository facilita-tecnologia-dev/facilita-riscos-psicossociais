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
            @if ($company->logo)
                <img src="{{ $companyLogo }}" class="h-8 object-scale-down transition hover:scale-105 md:h-10" alt="Logomarca" />
            @endif

            <h2 style="margin-bottom: 18px">{{ $company->name }}</h2>
            <h1 style="margin-bottom: 8px; font-size: 32px">Inventário de Riscos Psicossociais</h1>
            <p style="font-size: 16px">Resultado detalhado da avaliação de riscos psicossociais divido por função.</p>
        </x-pdf.cover>

        <div class="page-break"></div>

        @foreach ($risks as $occupation => $occupationRisks)
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left">Função</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h2 style="font-size: 16px">{{ $occupation }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($company->usesHSE())
                @foreach ($occupationRisks as $groups)
                    @foreach ($groups as $hazard => $risk)
                        <table style="margin-top: 28px">
                            <tbody>
                                <tr>
                                    <td style="width: 40%">
                                        <span style="font-size: 8px; display: block; margin: 0 2px 0 2px">Setor: {{ $occupation }}</span>
                                        <p>Perigo Psicossocial:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\HSE\HSEHazard::from($hazard)->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Severidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\HSE\HSEGravity::from($risk['risk']['gravity'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Probabilidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\HSE\HSEProbability::from($risk['risk']['probability'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%; background-color: {{ $risk['risk']['evaluated']->color() }}">
                                        <p>Risco Identificado:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ $risk['risk']['evaluated']->label() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table>
                            <thead>
                                <th style="width: 40%; font-size: 10px">Medida de Controle</th>
                                <th style="width: 20%; font-size: 10px">Prazo</th>
                                <th style="width: 20%; font-size: 10px">Responsável</th>
                                <th style="width: 20%; font-size: 10px">Situação</th>
                            </thead>
                            <tbody>
                                @foreach ($risk['control_actions'] as $action)
                                    <tr>
                                        <td style="width: 40%; font-size: 10px">{{ $action['content'] }}</td>
                                        <td style="width: 20%; font-size: 10px">{{ $action['deadline'] ?? 'Indefinido' }}</td>
                                        <td style="width: 20%; font-size: 10px">{{ $action['assignee'] ?? 'Indefinido' }}</td>
                                        <td style="width: 20%; font-size: 10px">{{ $action['status'] ?? 'Indefinido' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endforeach
            @else
                @foreach ($occupationRisks as $groups)
                    @foreach ($groups as $hazard => $risk)
                        <table style="margin-top: 28px">
                            <tbody>
                                <tr>
                                    <td style="width: 40%">
                                        <span style="font-size: 8px; display: block; margin-bottom: 4px">Função: {{ $occupation }}</span>
                                        <p>Perigo Psicossocial:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\PROART\PROARTHazard::from($hazard)->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Severidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\PROART\PROARTGravity::from($risk['risk']['gravity'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Probabilidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\PROART\PROARTProbability::from($risk['risk']['probability'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%; background-color: {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::CRITICAL ? '#fc6f6f50' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::HIGH ? '#dc933250' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::MEDIUM ? '#faed5d50' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::LOW ? '#76fc7150' : '' }}">
                                        <p>Risco Identificado:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ $risk['risk']['evaluated']->label() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table>
                            <thead>
                                <th style="width: 40%; font-size: 10px">Medida de Controle</th>
                                <th style="width: 15%; font-size: 10px">Tipo</th>
                                <th style="width: 15%; font-size: 10px">Prazo</th>
                                <th style="width: 15%; font-size: 10px">Responsável</th>
                                <th style="width: 15%; font-size: 10px">Situação</th>
                            </thead>
                            <tbody>
                                @foreach ($risk['control_actions'] as $actionType => $actions)
                                    @foreach ($actions as $action)
                                        <tr>
                                            <td style="width: 40%; font-size: 10px">{{ $action['content'] }}</td>
                                            <td style="width: 15%; font-size: 10px">{{ App\Enums\PROART\PROARTControlActionTypes::from($actionType)->label() }}</td>
                                            <td style="width: 15%; font-size: 10px">{{ $action['deadline'] ?? 'Indefinido' }}</td>
                                            <td style="width: 15%; font-size: 10px">{{ $action['assignee'] ?? 'Indefinido' }}</td>
                                            <td style="width: 15%; font-size: 10px">{{ $action['status'] ?? 'Indefinido' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endforeach
            @endif
            @if (! $loop->last)
                <div class="page-break"></div>
            @endif
        @endforeach

        @if ($company->usesHSE())
            <div class="page-break"></div>

            <x-pdf.cover>
                @if ($company->logo)
                    <img src="{{ $companyLogo }}" style="max-width: 8cm; object-fit: contain; margin-bottom: 24px" />
                @endif

                <h2 style="margin-bottom: 18px">{{ $company->name }}</h2>
                <h1 style="margin-bottom: 8px; font-size: 32px">Relatório de Afastamentos</h1>
                <p style="font-size: 16px">Lista de afastamentos registrados agrupados por função.</p>
            </x-pdf.cover>

            <div class="page-break"></div>

            @foreach ($absences as $evaluationFactor => $factorAbsences)
                <table style="margin-top: 28px">
                    <tbody>
                        <tr>
                            <td style="width: 100%">
                                <p>Função:</p>
                                <span style="font-weight: bold; margin: 2px">{{ $evaluationFactor }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table>
                    <thead>
                        <th style="width: 20%; font-size: 10px">Código CID</th>
                        <th style="width: 20%; font-size: 10px">Data de Registro</th>
                        <th style="width: 20%; font-size: 10px">Setor</th>
                        <th style="width: 20%; font-size: 10px">Função</th>
                        <th style="width: 20%; font-size: 10px">Duração</th>
                    </thead>
                    <tbody>
                        @foreach ($factorAbsences as $absence)
                            <tr>
                                <td style="width: 20%; font-size: 10px">{{ $absence->cid->type }}</td>
                                <td style="width: 20%; font-size: 10px">{{ $absence->created_at->format('d/m/Y') }}</td>
                                <td style="width: 20%; font-size: 10px">{{ $absence->department }}</td>
                                <td style="width: 20%; font-size: 10px">{{ $absence->occupation }}</td>
                                <td style="width: 20%; font-size: 10px">{{ $absence->duration }} dias</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endif

        <x-pdf.footer />
    </body>
</html>
