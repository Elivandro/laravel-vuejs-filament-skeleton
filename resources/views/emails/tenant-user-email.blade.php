<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova mensagem recebida</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 24px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            color: #333;
            font-size: 22px;
        }

        p {
            color: #555;
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
        }

        .divider {
            margin: 24px 0;
            border-top: 1px solid #eaeaea;
        }

        .box {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 16px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .footer {
            margin-top: 32px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }

        .footer a {
            color: #569F88;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2>Olá, {{ $user->name }} 👋</h2>

        <p>
            Você recebeu uma nova mensagem através do formulário de contato do seu tenant.
        </p>

        <div class="divider"></div>

        <div class="box">
            <p>
                <span class="label">Nome do remetente:</span><br>
                {{ $data['name'] }}
            </p>

            <p>
                <span class="label">E-mail:</span><br>
                {{ $data['email'] }}
            </p>

            <p>
                <span class="label">Mensagem:</span><br>
                {{ $data['message'] }}
            </p>
        </div>

        <div class="divider"></div>

        <p class="footer">
            Esta mensagem foi enviada automaticamente pelo sistema.<br>
            © {{ date('Y') }} — Seu aplicativo de gestão
        </p>

    </div>
</body>
</html>
