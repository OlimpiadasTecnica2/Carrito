<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Servicios</title>
		<link rel="stylesheet" type="text/css" href="./pages/styles.css">

</head>

<body>
<?php include './pages/header.php' ?>

	<div class="cont-card">

<?php	
$db = new \PDO('sqlite:api/base.db');
$stmt = $db->query("SELECT id, nombre, descripcion, precio, imagen FROM productos");
$productos = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
if (isset($_COOKIE['id'])){
	$stmt = $db->prepare("SELECT email, contraseña FROM usuarios WHERE id = ?");
	$stmt -> execute([$_COOKIE["id"]]);
	$usuario = $stmt -> fetch(\PDO::FETCH_ASSOC);
}
include 'admin/admin_user.php';

foreach ($productos as $item) : 
?>
	  	
	<div class="card" id="<?php echo $item['id']; ?>">
	  		<video class="card-img-top" loop="true" muted autoplay style width="840" height="560">
				<source src="<?php echo $item['imagen']; ?>" type="video/mp4">
 			</video>
			<div class="card-body">
	        	<h5 class="card-title"><?php echo $item['nombre']; ?></h5>
	        	<h5>$<?php echo $item['precio']; ?></h5>
				<button class="compra" onclick="post_carrito(<?php echo $item['id']; ?>);">AGREGAR</button>
	        	<p class="info"><?php echo $item['descripcion']; ?></p>
	     	</div>
			 <?php if (isset($usuario['email']) && $usuario['email'] == $admin_email && $usuario['contraseña'] == $admin_password) : ?>
				<form action="api/productos_del.php" method="POST" >
					<input  type="number" value="<?php echo $item['id']; ?>" name="id" hidden>
					<button type="submit">ELIMINAR</button>
				</form>
			<?php endif;?>
		</div>
	<?php endforeach; ?>
	<?php if (isset($usuario['email']) && $usuario['email'] == $admin_email && $usuario['contraseña'] == $admin_password) : ?>
		<div class="card" id="new_product">
			<h3>Añadir nuevo producto</h3>
	  		<form action="api/productos.php" method="POST">
			<label for="imagen">Imagen</label>	
			<input type="text" name="imagen">
			<div class="card-body">
			<label class="card-title" for="nombre">Nombre</label>	
			<input class="card-title" type="text" name="nombre">
			<label  for="precio">Precio</label>	
			<input type="number" name="precio">
			<label  for="descripcion">Descripcion</label>	
			<input  type="text" name="descripcion">
				<button class="compra" type="submit">AGREGAR</button>
				</form>
		</div>
	</div>
	<?php endif;?>
	
	</div>		
	
	<script type="text/javascript" src="pages/compra/compra.js"></script>
<?php include 'pages/footer.php' ?> 

	</body>
	</html>