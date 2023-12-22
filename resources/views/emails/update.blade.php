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
        .error {
            color: red;
        }
    </style>
    <title>Benutzer Mutation</title>
</head>
<body>
    <div class="content">
        <h1>Benutzer Mutation</h1>
        <div class="body">
            <p>Guten Tag Soldat. Ihr Benutzer wurde durch {{$admin}} mutiert.</p>
            <br />
            <p>Datenabgleich:</p>
            @if ($oldUser->identification != $newUser->identification)
                <p>Name: {{$oldUser->identification}} -> {{$newUser->identification}}</p>
            @endif
            @if ($oldUser->email != $newUser->email)
                <p>Email: {{$oldUser->email}} -> {{$newUser->email}}</p>
            @endif
            @if ($oldUser->rank->rank != $newUser->rank->rank)
                <p>Rang: {{$oldUser->rank->rank}} -> {{$newUser->rank->rank}}</p>
            @endif
            @if ($oldUser->restrictionClass != $newUser->restrictionClass)
                <p>Freigabe: {{$oldUser->restrictionClass}} -> {{$newUser->restrictionClass}}</p>
            @endif
            <!--If nothing changed-->
            @if ($oldUser->identification == $newUser->identification && $oldUser->email == $newUser->email && $oldUser->rank->rank == $newUser->rank->rank && $oldUser->restrictionClass == $newUser->restrictionClass)
                <p class="error">Es wurden keine Sichtbaren änderungen vorgenommen.</p>
                <p class="error">Bitte melden Sie sich bei Ihrem Supervisor.</p>
            @endif
            <br />
            <br />
            <p>Bei Fragen wenden Sie sich an Ihren Supervisor.</p>
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