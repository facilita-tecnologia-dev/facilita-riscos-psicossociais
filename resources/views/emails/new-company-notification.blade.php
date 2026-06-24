<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova empresa cadastrada</title>

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
        }

        .content {
            padding: 24px;
            color: #1F1F1F;
        }

        .content p {
            margin-bottom: 12px;
            font-size: 16px;
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
        <h1>Nova empresa cadastrada</h1>
    </header>

    <div class="content">
        <p>
            Uma nova empresa foi cadastrada no sistema.
        </p>

        <p>
            <strong>Razão social:</strong> {{ $company->name }}
        </p>

        <p>
            <strong>CNPJ:</strong> {{ $company->cnpj }}
        </p>

        <p>
            <strong>Data:</strong> {{ now()->format('d/m/Y - H:i') }}
        </p>

        @if($company->usesExternalBilling())
            <p>
                <strong>Forma de cobrança:</strong> Gerenciada externamente
            </p>
        @else

            <p>
                <strong>Faixa:</strong>
                {{ \App\Services\Subscription\SubscriptionPricingService::employeeRange($employeesCount) }}
            </p>

            <p>
                <strong>Pagamento:</strong>
                {{ $paymentType->label() }}
            </p>

        @endif

    </div>

    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }}
    </div>

</div>
</body>
</html>