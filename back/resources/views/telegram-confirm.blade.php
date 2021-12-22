<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Подтверждение telegram</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            @import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css");

            body {
                font-family: 'Nunito', sans-serif;
            }

            .center {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    </head>
    <body>
        <div class="center">
            <script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="<?= getenv('SOCIAL_TELEGRAM_BOT_USERNAME') ?>"
                    data-size="large" data-auth-url="auth/tg?access_token={{ $access_token }}&"></script>
        </div>
    </body>

</html>
