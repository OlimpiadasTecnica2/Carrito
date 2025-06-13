<!DOCTYPE html>
<html>
	<head>	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./pages/styles.css">
</head>

<body>

<?php include './pages/header.php' ?> 


<form id="loginForm" >
	<label for="email">Correo Electrónico:</label>
	<input type="email" id="email" name="email" placeholder="Ingresar email" required>
  
	<label for="password">Contraseña:</label>
	<input type="password" placeholder="Ingresar su contraseña" id="password" name="contraseña" required>
  
	<button type="submit">Iniciar Sesión</button>
	<a href="/index.php">Cancelar</a>
	<p>¿No tienes una cuenta?<a href="registro.php">Registrese</a></p>

</form>
 
  <script type="text/javascript" src="pages/login/login.js"></script>
<?php include './pages/footer.php' ?> 

</body>
</html>