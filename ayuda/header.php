<div>
<h1 class="titulo">Paquetes Turísticos</h1>
<div class="barra-superior">
<?php if(!isset($_COOKIE['id'])) : ?>
<div class="login-bar">
		<a class="boton-barra" href="/login.php">Login</a>
		<a class="boton-barra" href="/registro.php">Registrarse</a>
</div>
		<?php else : ?>
<div class="login-bar">
		<button class="boton-barra"  id="logout">Logout</button>
	</div>
<?php endif; ?>
	<div class="carrito-bar">
		<a class="boton-barra" href="/carrito.php">🛒 Carrito</a>
	</div>
</div>

	<ul class="menu">
		<li class="item"><a class="item-link" href="/index.php" >INICIO</a></li>
		<li class="item"><a class="item-link" href="/facturas.php" >FACTURAS</a></li>
	    <li class="item"><a class="item-link" href="/compra.php">SERVICIOS</a></li>
	</ul>
</div>
