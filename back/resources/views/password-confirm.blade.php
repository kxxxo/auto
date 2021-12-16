<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Подтверждение пароля</title>

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

        #password-input {
            width: 250px;
        }

        input {
            padding: 10px;
            border-radius: 2px;
            border: 1px solid #ccc;
        }

        input::placeholder {
            color: #BBB;
        }

        button {
            width: 60px;
            height: 42px;
            border-radius: 0;
            border: 1px solid #ccc;
            background: white;
        }

        span.glyphicon {
            color: #36a919;
        }

        button:disabled > span.glyphicon {
            color: dimgrey;
        }

        .error {
            visibility: hidden;
            color: #d02121;
        }

        @media (max-width: 627px) {
            button {
                margin-top: 5px;
                width: 250px;
            }
        }


    </style>
</head>
<body>
<div class="center">
    <div id="send-password-form">
        <label for="password-input"></label>
        <input type='text'
           placeholder="XXXXXXXX"
           id="password-input"
        >
        <button id="send-password" disabled="disabled">
            <span class="glyphicon glyphicon-ok"></span>
        </button>
    </div>
    <br/>
    <span class="error">
        &nbsp;
    </span>
</div>
</body>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="/src/maskedinput/jquery.maskedinput.min.js"></script>

<script>
    $("#password-input").mask("99999999", {
        completed: function () {
            $("#send-password").prop("disabled", false);
        }
    }).on('keypress', function (e) {
        if (e.which === 13) {
            $("#send-password").click();
        }
    });

    let allowed_tries = 5;
    $("#send-password").click(function () {
        $("#send-password").prop("disabled", true);
        let value = $("#password-input").val();
        if (value.length !== 8) {
            $(".error").html("* Введите корректный пароль")
                .css('visibility', 'visible');
        } else {
            $.get("/password-confirm/auth", {
                password: value,
                id: {{ Request::get('id') }}
            }).done(function (data) {
                if (data) {
                    document.location.replace('<?= getenv('FRONTEND_APP_URL') ?>/authorization/' + data);
                    // redirect to front page with bearer
                } else {
                    if (allowed_tries > 0) {
                        allowed_tries--;
                        $(".error").html("* Неверный пароль. Осталось попыток: " + allowed_tries)
                            .css('visibility', 'visible');
                        $("#password-input").val("");
                    } else {
                        document.location.replace('<?= getenv('FRONTEND_APP_URL') ?>');
                    }
                }
            }).fail(function (e) {
                $(".error").html(e.responseText)
                    .css('visibility', 'visible');
                $("#password-input").val("");
            });
        }
    });
</script>

</html>
