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
	<form id="registroForm">
		<label for="nombre">Nombre completo:</label>
		<input type="text" id="nombre" name="nombre" required>
		<label for="email">Correo Electronico:</label>
		<input type="email" id="email" name="email" required>

		<label for="password">Contraseña</label>
		<input type="password" id="password" name="contraseña" required>

		<button type="submit">Registrar</button>
</form>

		<p>¿Ya tenes cuenta?<a href="login.html">Iniciar Sesion</a></p>
</div>
<script type="text/javascript" src="registro.js"></script>

<?php include './pages/footer.php' ?> 

</body>
</html>