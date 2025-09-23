<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinição de Senha</title>
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
            background-color: #ffffff;
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

        .button {
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
            <h1>Redefinição de Senha</h1>
        </header>
        <div class="content">
            <p>Recebemos uma solicitação de redefinição de senha no <strong>Facilita Riscos Psicossociais</strong>.</p>
            <p>Clique no botão abaixo para acessar a página de redefinição de senha</p>

            <a href="{{ $url }}" class="button">
                Redefinir Senha
            </a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>