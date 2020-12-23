<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Bienvenido a la versión beta de la plataforma de Test interactiva del Grupo Meforma, para acceder a ella por favor inicia sesión con el siguiente usuario y contraseña:</p>
    <ul>
        <li>usuario: {{ $user->email }}</li>
        <li>contraseña: {{ $password }}</li>
    </ul>
    <p>Para cualquier sugerencia o duda contáctanos en contacto@grupomeforma.com</p>
</body>
</html>
