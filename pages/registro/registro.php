<!DOCTYPE html>
<html>
<head>	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="./pages/styles.css">
</head>
<body>
<?php include './pages/header.php' ?> 



	<div class="containerregistro">
	<h2>Registro de Nuevo Cliente</h2>
	<form id="formulario">
		<label for="email">Correo Electronico:</label>
		<input type="email" id="email" name="email" required>
		<label for="password">Contraseña</label>
		<input type="password" id="password" name="contraseña" required>
		<label for="confirmPassword">Confirmar contraseña</label>
		<input type="password" id="confirmPassword" name="confirmPassword" required>	
		<label for="titular">Titular de tarjeta</label>
		<input type="text" id="titular" name="titular" required>
		<label for="numero_tarjeta">Numero de tarjeta</label>
		<input type="number" id="tarjeta" name="numero_tarjeta" required>
		<label for="fecha_vencimiento">Fecha de vencimiento</label>
		<input type="number" id="vencimiento" name="fecha_vencimiento" required>
		<label for="cvv">CVV</label>
		<input type="number" id="cvv" name="cvv" required>
		<label for="direccion">Direccion</label>
		<input type="text" id="direccion" name="direccion" required>
		<button type="submit">Registrar</button>
</form>

		<p>¿Ya tenes cuenta?<a href="login.html">Iniciar Sesion</a></p>
</div>
<script type="text/javascript" src="pages/registro/registro.js"></script>

<?php include './pages/footer.php' ?> 

</body>
</html>