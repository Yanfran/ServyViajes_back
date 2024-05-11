<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recupera tu contraseña ServyViajes</title>
</head>
<body>
    <h3>Recupera tu contraseña ServyViajes</h3>

    <p>!Hola {{ $userName }} !</p>

    <p>Has solicitado la recuperación de tu contraseña Servyviajes</p>
    <p>Por favor, sigue las instrucciones del siguiente enlace para recuperar tu contraseña Servyviajes</p>

    <p>
        Restablece tu contraseña aquí: 
        <a href="{{ $url_reset_password }}" target="_blank">
            Restablecer contraseña
        </a>
    </p>

    <p>Si no has solicitado el cambio de la contraseña,</p>
    <p>por tu seguridad te sugerimos que ingreses a tu perfíl</p>
    <p>de SevyViajes y que la cambies para asegurarte de que no ha sido comprometida.</p>

    <p>El Equipo ServyViajes</p>

</body>
</html>