<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Inventário de Riscos Psicossociais</title>

  <style>
    body { 
        font-family: Arial, Helvetica, sans-serif; 
        font-size: 14px; 
        color:#1f2937; 
        margin: 20px 16px 30px 16px;
    }

    table {margin:0 auto; width:100%; border-collapse:collapse;}
    td, th {border:1px solid #999; padding: 5px; vertical-align:center; font-size:12px; color: #333;}
    th {background-color: #E0E0E0; color: #333;}

    p, h2 {margin: 2px;}

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
        @if(session('auth:company')->logo)
            <img src="{{ public_path(session('auth:company')->logo) }}" style="max-width: 8cm; object-fit:contain; margin-bottom: 24px;">            
        @endif
        <h2 style="margin-bottom: 18px;">{{ session('auth:company')->name }}</h2>
        <h1 style="margin-bottom: 8px; font-size: 32px;">Inventário de Riscos Psicossociais</h1>
        <p style="font-size: 16px;">Resultado detalhado da avaliação de riscos psicossociais divido por setor.</p>
    </x-pdf.cover>

    <div class="page-break"></div>

    @foreach ($risks as $department => $departmentRisks)
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Setor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h2 style="font-size: 16px;">{{ $department }}</h2>
                    </td>
                </tr>
            </tbody>
        </table>

        @foreach ($departmentRisks as $type => $risk)
            <table style="margin-top: 28px;">
                <tbody>
                    <tr>
                        <td style="width:40%;">
                            <span style="font-size: 8px; display:block; margin: 0 2px 0 2px;">Setor: {{ $department }}</span>
                            <p>Perigo Psicossocial:</p> 
                            <span style="font-weight:bold; margin: 2px;">{{ App\Enums\RiskTypes::from($type)->label() }}</span>
                        </td>
                        <td style="width:20%;">
                            <p>Severidade:</p> 
                            <span style="font-weight:bold; margin: 2px;">{{ App\Enums\GravityTypes::from($risk['risk']['gravity'])->label() }}</span>
                        </td>
                        <td style="width:20%;">
                            <p>Probabilidade:</p> 
                            <span style="font-weight:bold; margin: 2px;">{{ App\Enums\ProbabilityTypes::from($risk['risk']['probability'])->label() }}</span>
                        </td>
                        <td style="width:20%; background-color:
                                {{ $risk['risk']['evaluated'] == App\Enums\FinalRiskTypes::CRITICAL ? '#fc6f6f50' : '' }}
                                {{ $risk['risk']['evaluated'] == App\Enums\FinalRiskTypes::HIGH ? '#dc933250' : '' }}
                                {{ $risk['risk']['evaluated'] == App\Enums\FinalRiskTypes::MEDIUM ? '#faed5d50' : '' }}
                                {{ $risk['risk']['evaluated'] == App\Enums\FinalRiskTypes::LOW ? '#76fc7150' : '' }}
                        ">
                            <p>Risco Identificado:</p> 
                            <span style="font-weight:bold; margin: 2px;">{{ $risk['risk']['evaluated']->label() }}</span>
                        </td>
                    </tr>                            
                </tbody>
            </table>

            <table>
                <thead>
                    <th style="width:40%; font-size: 10px">Medida de Controle</th>
                    <th style="width:15%; font-size: 10px">Tipo</th>
                    <th style="width:15%; font-size: 10px">Prazo</th>
                    <th style="width:15%; font-size: 10px">Responsável</th>
                    <th style="width:15%; font-size: 10px">Situação</th>
                </thead>
                <tbody>
                    @foreach ($risk['control_actions'] as $actionType => $actions) 
                        @foreach ($actions as $action) 
                            <tr>
                                <td style="width:40%; font-size: 10px;">{{ $action->content }}</td>
                                <td style="width:15%; font-size: 10px;">{{ App\Enums\ControlActionTypes::from($actionType)->label() }}</td>
                                <td style="width:15%; font-size: 10px;">{{ $action->deadline ?? 'Indefinido' }}</td>
                                <td style="width:15%; font-size: 10px;">{{ $action->assignee ?? 'Indefinido' }}</td>
                                <td style="width:15%; font-size: 10px;">{{ $action->status ?? 'Indefinido' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endforeach


        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    

    <x-pdf.footer />
</body>
</html>