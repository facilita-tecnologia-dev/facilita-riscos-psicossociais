<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <title>Relatório Mensal</title>

    <style>
        body {
            background-color: #FAFAFA;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #FAFAFA;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        header {
            background-color: #5EC8BC;
            color: #FAFAFA;
            padding: 18px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .content {
            padding: 24px;
            color: #1F1F1F;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .metric {
            margin-bottom: 16px;
        }

        .footer {
            background-color: #F5F5F5;
            color: #5F6368;
            padding: 16px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="email-container">

    <header>
        <h1>
            Relatório Mensal
        </h1>
    </header>

    <div class="content">

        <p>
            Resumo referente ao mês de
            <strong>{{ ucfirst($report['month']) }}</strong>.
        </p>

        <div class="metric">
            <p>
                <strong>Empresas cadastradas:</strong>
                {{ $report['companies_created'] }} empresa(s)
            </p>
        </div>

        <div class="metric">
            <p>
                <strong>Empresas por assinatura:</strong>
                {{ $report['subscription_companies'] }} empresa(s)
            </p>
        </div>

        <div class="metric">
            <p>
                <strong>Empresas com cobrança externa:</strong>
                {{ $report['external_billing_companies'] }} empresa(s)
            </p>
        </div>

        <div class="metric">
            <p>
                <strong>Questionários respondidos:</strong>
                {{ number_format($report['questionnaires_answered'], 0, ',', '.') }} resposta(s)
            </p>
        </div>

    </div>

    <div class="footer">
        &copy; {{ date('Y') }}
        {{ config('app.name') }}.
        Todos os direitos reservados.
    </div>

</div>

</body>
</html>