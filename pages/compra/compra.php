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

	
	<div class="cont-card">

<?php	
$db = new \PDO('sqlite:api/base.db');
$stmt = $db->query("SELECT id, nombre, descripcion, precio, imagen FROM productos");
$productos = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
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
		</div>
	<?php endforeach; ?>

	</div>		
	<div class="containercompra">
		<h2></h2>
		<div id= "resumenCompra">
			<!--El resumen de compra se cargara aqui-->
		</div>
	</div>
	<script type="text/javascript" src="pages/compra/compra.js"></script>
<?php include 'pages/footer.php' ?> 

	</body>
	</html>