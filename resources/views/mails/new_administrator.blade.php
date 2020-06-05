<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>¡Hola! estas son las credenciales para su acceso administrador a Meforma.com:</p>
    <ul>
        <li>correo eletrónico: {{ $user->email }}</li>
        <li>contraseña: {{ $password }}</li>
    </ul>
</body>
</html>