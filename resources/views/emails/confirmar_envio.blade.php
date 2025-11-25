<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Envío</title>
</head>
<body>
    <p>¡Hola {{ $nombre }}!</p>

    <p>Te enviamos este mail desde Pétalos Textil para confirmar que tu pedido ya está en viaje</p>

    <p> {{ $msgComprador }} </p>

    <p>Podes hacer el seguimiento mediante el siguiente enlace</p>
    <p> {{ $linkSeguimiento }} </p>
    <p>¡¡Muchas gracias por habernos elegido!!</p>
    <p>Pétalos Textil</p>
</body>
</html>
