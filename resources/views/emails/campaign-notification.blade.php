<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Campanha Ativa</title>
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
            font-weight: semibold;
        }

        .content {
            padding: 24px;
            color: #1F1F1F;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        p{
            margin: 0;
        }

        .top p{
            margin-bottom: 16px;
        }

        .campaign-infos{
            margin-top: 24px;
        }

        .campaign-infos h2{
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .campaign-infos p{
            margin-top: 12px;
        }

        .link, .link:visited {
            display: inline-block;
            margin-top: 20px;
            background-color: #5EC8BC;
            color: #FAFAFA;
            border-width: 2px;
            border-color: #5EC8BC;
            border-radius: 4px;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: semibold;
            font-size: 14px;
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
            <h1>Campanha de Testes Ativa</h1>
        </header>
        <div class="content">
            <div class="top">
                <p>Olá <strong>{{ $user->name ?? 'usuário' }}</strong>,</p>
                <p>A empresa <strong>{{ $company->name }}</strong> está com uma nova <strong>campanha de testes ativa</strong> neste momento.</p>
            </div>

            <div class="campaign-infos">
                <p>Nome da campanha: <strong>{{ $campaign->name }}</strong></p>
                @if($campaign->description)
                    <p>Descrição da campanha: <strong>{{ $campaign->description }}</strong></p>
                @endif
                <p>Data de início: <strong>{{ $campaign->start_date->format('d/m/Y - H:i') }}</strong></p>
                <p>Data de encerramento: <strong>{{ $campaign->end_date->format('d/m/Y - H:i') }}</strong></p>
            </div>

            <a href="{{ route('user.login') }}" class="link">
                Acessar sistema
            </a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>