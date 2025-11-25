<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de venta</title>
</head>
<body>
    <p>¡Hola {{ $nombre }}!</p>
    <p>Te enviamos este mail desde Pétalos Textil para confirmar la compra de: </p>

    <ul>
        @foreach ($productos as $prod)
            <li>{{ $prod->nombre }}</li>
        @endforeach
    </ul>

    <p>En nuestro sistema, tu compra está registrada con el número: <strong> {{ $nroVenta }}, </strong> podes contactarnos al e-mail: rmerlo@gmail.com</p>

    <p>Cuando verifiquemos el pago, iniciaremos el envío de tus productos y te enviaremos un e-mail de confirmacion con un link de seguimiento.</p>
    <p>¡¡Muchas gracias por habernos elegido!!</p>
    <p>Pétalos Textil</p>
</body>
</html>
