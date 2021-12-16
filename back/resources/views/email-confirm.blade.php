<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Подтверждение электронной почты</title>

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

        #email-input {
            width: 250px;
        }

        #code-input {
            width: 185px;
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

        #send-code-form {
            display: none;
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
    <div id="send-email-form">
        <input type='email'
               placeholder="info@mail.ru"
               id="email-input"
        >
        <button id="send-email">
            <span class="glyphicon glyphicon-ok"></span>
        </button>
    </div>
    <div id="send-code-form">
        <input type='text'
               placeholder="000000"
               id="code-input"
        >
        <button id="resend-code">
            <span class="glyphicon glyphicon-repeat"></span>
        </button>
        <button id="send-code" disabled="disabled">
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
    $("#email-input").on('keypress', function (e) {
        if (e.which === 13) {
            $("#send-email").click();
        }
    });

    $("#send-email").click(function () {
        let value = $("#email-input").val()
            .replaceAll('(', '')
            .replaceAll(')', '')
            .replaceAll('+', '')
            .replaceAll('-', '')
            .replaceAll(' ', '');
        if (!validateEmail(value)) {
            $(".error").html("* Введите корректный email")
                .css('visibility', 'visible');
        } else {
            $("#send-email").prop("disabled", true);
            $.get("/email-confirm/send-code", {
                email: value
            }).done(function (data) {
                $(".error").css('visibility', 'hidden');
                $("#send-email-form").hide();
                $("#send-code-form").show();
            }).fail(function (e) {
                $(".error").html(e.responseText)
                    .css('visibility', 'visible');
                $("#email-input").val("");
                $("#send-email").prop("disabled", false);
            });
        }
    });


    $("#code-input").mask("999999", {
        completed: function () {
            $("#send-code").prop("disabled", false);
        }
    }).on('keypress', function (e) {
        if (e.which === 13) {
            $("#send-code").click();
        }
    });

    let allowed_tries = 3;
    $("#send-code").click(function () {
        $("#send-code").prop("disabled", true);
        let email = $("#email-input").val()
            .replaceAll(' ', '');
        let code = $("#code-input").val();
        $.get("/email-confirm/auth", {
            email: email,
            code: code
        }).done(function (data) {
            if (data) {
                document.location.replace('<?= getenv('FRONTEND_APP_URL') ?>/authorization/' + data);
                // redirect to front page with bearer
            } else {
                if (allowed_tries > 0) {
                    allowed_tries--;
                    $(".error").html("* Неверный код. Осталось попыток: " + allowed_tries)
                        .css('visibility', 'visible');
                    $("#code-input").val("");
                } else {
                    $("#resend-code").click();
                }
            }
        }).fail(function (e) {
            $(".error").html(e.responseText)
                .css('visibility', 'visible');
            $("#code-input").val("");
        });

    });
    $("#resend-code").click(function () {
        document.location.reload();
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>

</html>
