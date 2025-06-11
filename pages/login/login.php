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





<form id="loginForm" action='api/login.php' method='POST'>
	<label for="email">Correo Electrónico:</label>
	<input type="email" id="email" name="email" required>
  
	<label for="password">Contraseña:</label>
	<input type="password" id="password" name="contraseña" required>
  
	<button type="submit">Iniciar Sesión</button>
  </form>
  <script type="text/javascript" src="login.js"></script>
<?php include './pages/footer.php' ?> 

</body>
</html>