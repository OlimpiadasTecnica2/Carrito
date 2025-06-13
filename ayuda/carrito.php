<!DOCTYPE html>
<html>
	<head>	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="../pages/styles.css">
</head>

<body>

<?php include './header.php' ?> 
<h3>Que es?</h3>
<h4>La seccion de carrito muestra los servicios que el usuario agrego mientras estaba en la seccion de <a href="servicios.php">servicios</a></h4>
<br>
<h3>Como lo realizo?</h3>
<h4>Para acceder clickeas el boton de "Carrito" en la parte superior derecha</h4>
<hr>
<h4>A continuacion, si estas <a href="login.php">iniciado sesion</a> puedes modificar la cantidad de los serivicios,visualizar un subtotal, el total y proceder con el proceso de compra </h4>
<hr>
<h4>Al apretar el boton de "Comprar" se le lleva a un formulario en donde debe colocar sus datos: </h4>
<hr>
<h4>Metodo de pago:</h4>
<h5>Si es tarjeta de debito o credito debe colocar:</h5>
<ul>
	<li>Titular</li>
	<li>Numero de tarjeta</li>
	<li>Fecha de vencimiento</li>
	<li>Codigo de seguridad (CVV)</li>
	<li>Y la direccion del titular</li>
</ul>
<h5>Si es transferencia solo basta con apretar el boton inferior para confirmar la transaccion</h5>
<hr>
<h4>Otro consumidor final:</h4>
<h5>A continuacion opcionalmente puede definir a otro consumidor final, al incluir eso tiene que colocar:</h5>
<ul>
	<li>Nombre del consumidor final</li>
	<li>Apellido</li>
	<li>Y el DNI</li>
</ul>
<hr>
<h4>A continuacion, apretar el boton de "Comprar"</h4>
<br>
<h3>Como se que se me realizo la compra?</h3>
<h4>Se te sera redirigido automaticamente a la seccion del carrito, aparecera una seccion que dice "Cargando...", mientras eso aparece usted debe esperar, a continuacion aparecera su <a href="factura.php">factura</a> en la pantalla y le llegara un Email de la misma</h4>
<?php include './footer.php' ?> 

</body>
</html>