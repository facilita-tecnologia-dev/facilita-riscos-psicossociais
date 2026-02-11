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
            <h1 style="margin-bottom: 8px; font-size: 32px">Inventário de Riscos Psicossociais</h1>
            <p style="font-size: 16px">Resultado detalhado da avaliação de riscos psicossociais divido por setor.</p>
        </x-pdf.cover>

        <div class="page-break"></div>

        @if($company->usesHSE())
            <div style="margin-bottom: 24px">
                <h2 style="margin-bottom: 16px">Objetivo</h2>

                <p style="font-size: 1rem; line-height: 1.4em; color: #333; text-align: justify;">O objetivo deste Inventário é consolidar e apresentar, de forma estruturada e sistematizada, os riscos psicossociais identificados a partir da avaliação realizada com base nas respostas agregadas dos colaboradores. O documento tem como finalidade organizar os perigos mapeados por grupos de risco, evidenciando os fatores organizacionais que podem impactar a saúde mental, emocional e social dos trabalhadores, em conformidade com a NR-1.</p>
            </div>

            <div style="margin-bottom: 24px">
                <h2 style="margin-bottom: 16px">Metodologia</h2>

                <p style="font-size: 1rem; line-height: 1.4em; color: #333; text-align: justify;">A metodologia adotada para a avaliação dos riscos psicossociais baseia-se na organização e análise estruturada das respostas coletadas por meio de formulários, considerando grupos de perigos previamente definidos e fatores organizacionais como setor e função. Os dados são tratados de forma agregada, permitindo avaliar contextos de trabalho e não indivíduos. A partir dessa organização, um mecanismo técnico realiza a análise dos resultados conforme critérios específicos para cada tipo de perigo, podendo considerar informações complementares de saúde ocupacional quando disponíveis, garantindo coerência normativa, consistência técnica e maior precisão na identificação dos níveis de risco.</p>
            </div>

            <div style="margin-bottom: 24px">
                <h2 style="margin-bottom: 16px">Matriz de Risco</h2>

                <p style="font-size: 1rem; line-height: 1.4em; color: #333; text-align: justify;">
                    A matriz de risco é o instrumento utilizado para classificar e representar o nível de risco psicossocial identificado após a etapa de avaliação. Ela combina a probabilidade estimada de ocorrência com a gravidade previamente definida de cada perigo, permitindo posicionar o risco em níveis que facilitam sua interpretação.
                </p>

                <table style="border-radius: 8px; margin-top: 16px;">
                    <thead>
                        <th style="background-color: #E0E0E0; font-weight: bold;">Matriz de Risco</th>
                        <th style="background-color: #E0E0E0; font-weight: normal;">Leve</th>
                        <th style="background-color: #E0E0E0; font-weight: normal;">Baixa</th>
                        <th style="background-color: #E0E0E0; font-weight: normal;">Moderada</th>
                        <th style="background-color: #E0E0E0; font-weight: normal;">Alta</th>
                        <th style="background-color: #E0E0E0; font-weight: normal;">Extrema</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color: #E0E0E0;">Muito Improvável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TRIVIAL->color() }};">Trivial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TRIVIAL->color() }};">Trivial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                        </tr>
                        <tr>
                            <td style="background-color: #E0E0E0;">Improvável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TRIVIAL->color() }};">Trivial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::SUBSTANTIAL->color() }};">Substancial</td>
                        </tr>
                        <tr>
                            <td style="background-color: #E0E0E0;">Possível</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TRIVIAL->color() }};">Trivial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::SUBSTANTIAL->color() }};">Substancial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::INTOLERABLE->color() }};">Intolerável</td>
                        </tr>
                        <tr>
                            <td style="background-color: #E0E0E0;">Provável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::SUBSTANTIAL->color() }};">Substancial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::INTOLERABLE->color() }};">Intolerável</td>
                        </tr>
                        <tr>
                            <td style="background-color: #E0E0E0;">Muito Provável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::TOLERABLE->color() }};">Tolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::MODERATE->color() }};">Moderado</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::SUBSTANTIAL->color() }};">Substancial</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::INTOLERABLE->color() }};">Intolerável</td>
                            <td style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::INTOLERABLE->color() }};">Intolerável</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="page-break"></div>
        @endif
        
        @foreach ($risks as $department => $departmentRisks)
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left">Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h2 style="font-size: 16px">{{ $department }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if ($company->usesHSE())
                @foreach ($departmentRisks as $groups)
                    @foreach ($groups as $hazard => $risk)
                        <table style="margin-top: 28px">
                            <tbody>
                                <tr>
                                    <td style="width: 40%">
                                        <span style="font-size: 8px; display: block; margin: 0 2px 0 2px">Setor: {{ $department }}</span>
                                        <p>Perigo Psicossocial:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\HSE\HSEHazard::from($hazard)->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Severidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\HSE\HSEGravity::from($risk['risk']['gravity'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Probabilidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\HSE\HSEProbability::from($risk['risk']['probability'])->label() }}</span>
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
                @foreach ($departmentRisks as $groups)
                    @foreach ($groups as $hazard => $risk)
                        <table style="margin-top: 28px">
                            <tbody>
                                <tr>
                                    <td style="width: 40%">
                                        <span style="font-size: 8px; display: block; margin: 0 2px 0 2px">Setor: {{ $department }}</span>
                                        <p>Perigo Psicossocial:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\PROART\PROARTHazard::from($hazard)->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Severidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\PROART\PROARTGravity::from($risk['risk']['gravity'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%">
                                        <p>Probabilidade:</p>
                                        <span style="font-weight: bold; margin: 2px">{{ App\Enums\Psychosocial\PROART\PROARTProbability::from($risk['risk']['probability'])->label() }}</span>
                                    </td>
                                    <td style="width: 20%; background-color: {{ $risk['risk']['evaluated'] == App\Enums\Psychosocial\PROART\PROARTRisk::CRITICAL ? '#fc6f6f50' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\Psychosocial\PROART\PROARTRisk::HIGH ? '#dc933250' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\Psychosocial\PROART\PROARTRisk::MEDIUM ? '#faed5d50' : '' }} {{ $risk['risk']['evaluated'] == App\Enums\Psychosocial\PROART\PROARTRisk::LOW ? '#76fc7150' : '' }}">
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
                                            <td style="width: 15%; font-size: 10px">{{ App\Enums\Psychosocial\PROART\PROARTControlActionTypes::from($actionType)->label() }}</td>
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
            @if ($absences->isNotEmpty())
                <div class="page-break"></div>

                <x-pdf.cover>
                    @if ($company->logo)
                        <img src="{{ $companyLogo }}" style="max-width: 8cm; object-fit: contain; margin-bottom: 24px" />
                    @endif

                    <h2 style="margin-bottom: 18px">{{ $company->name }}</h2>
                    <h1 style="margin-bottom: 8px; font-size: 32px">Relatório de Afastamentos</h1>
                    <p style="font-size: 16px">Lista de afastamentos registrados agrupados por setor.</p>
                </x-pdf.cover>

                <div class="page-break"></div>

                @foreach ($absences as $evaluationFactor => $factorAbsences)
                    <table style="margin-top: 28px">
                        <tbody>
                            <tr>
                                <td style="width: 100%">
                                    <p>Setor:</p>
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
        @endif

        <x-pdf.footer />
    </body>
</html>
