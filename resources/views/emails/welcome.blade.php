<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            color: black;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.5rem;
            padding: 2rem;
            border-radius: 1rem;
        }
        .body {
            padding: 2rem;
            border-radius: 1rem;
        }
        .info {
            font-size: 0.5rem;

        }
        h1 {
            font-size: 2rem;
        }
        /*Add stuff for Phone users*/
        @media only screen and (max-width: 600px) {
            body {
                font-size: 0.7rem;
            }
            .body {
                padding: 0.7rem;
            }
            h1 {
                font-size: 1.2rem;
            }
        }
    </style>
    <title>Registrierungs Bestätigung</title>
</head>
<body>
    <div class="content">
        <h1>Registrierungs Bestätigung</h1>
        <div class="body">
            <p>Guten Tag Soldat. Sie wurden erfolgreich von {{$admin}} registriert.</p>
            <br />
            <p>Ihr Benutzername lautet: {{$name}}</p>
            <p>Ihr Passwort lautet: {{$password}}</p>
            <br />
            <br />
            <p>Beachten Sie dass Ihr Supervisor Ihr Passwort einsehen kann.</p>
            <br />
            <p>Bitte klicken Sie auf den Link um sich einzuloggen.</p>
            <a href="http://localhost:3000/login">Login</a>
            <br />
            <br />
            <p>Im namen des Republikanischen Oberkommandos.</p>
            <p> gez. Luke Connor</p>
            <br />
            <br />
            <br />
            <div class="info">
                <p>Diese Mail wurde automatisch generiert. Bitte antworten Sie nicht auf diese Mail.</p>
                <p>Sollten Sie nicht einverstanden sein dass Ihre Mailadresse benutzt wird, wenden Sie sich bitte an Jyods.engagement@gmx.net</p>
            </div>
        </div>
    </div>
</body>
</html>