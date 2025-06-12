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
<?php include 'admin/admin_user.php';
	 $db = new \PDO("sqlite:api/base.db");
	 $usuario_id = $_COOKIE['id'];
	 $stmt = $db->prepare("SELECT titular, email, contraseña FROM usuarios WHERE id = ?;");
	 $stmt->execute([$usuario_id]);
	 $res = $stmt -> fetch(\PDO::FETCH_ASSOC);
	 if (!$res){
		header("Location: /login.php");
		die();
	 }
	 if (!isset($_GET['orden'])){
		$_GET['orden'] = 'fecha';
	 }
	 if (isset($_GET['id'],$_GET['method'])){
		$stmt = $db->prepare("UPDATE facturas SET estado = ? WHERE id = ?;");
		$stmt->execute([$_GET['method'],$_GET['id']]);
	}

	 if ($res['email'] == $admin_email && $res['contraseña'] == $admin_password) :		
?>
	<header>
		<h2>Administrador</h2>
	<a href="facturas.php?orden=fecha">Ordenar por Fecha</a>	
	<a href="facturas.php?orden=id_usuario">Ordenar por Cuentas</a>
	<a href="facturas.php?orden=estado">Ordenar por Estado</a>
	</header>
	<?php else : ?>
	<header>
		<h2><?php echo $res['titular']; ?></h2>
		<a href="facturas.php?orden=fecha">Ordenar por Fecha</a>	
	<a href="facturas.php?orden=estado">Ordenar por Estado</a>
</header>
	<?php endif; ?>
	
	<div class="facturas_seleccion">
		<?php 
		if ($res['email'] == $admin_email && $res['contraseña'] == $admin_password){
			$stmt = $db->query("SELECT id, fecha , id_usuario, estado FROM facturas ORDER BY facturas.{$_GET['orden']} DESC;");
			$res = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
		}else{
		$stmt = $db->prepare("SELECT id, fecha , id_usuario, estado FROM facturas WHERE id_usuario = ? ORDER BY facturas.{$_GET['orden']} DESC;");
        $stmt->execute([$usuario_id]);
		$facturas = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
		}
		foreach ($facturas as $fac) :
		?>
		<div class="factura-marco">
			<div class="factura-head">
				<h4>FACTURA NUMERO:<?php echo $fac['id']; ?></h4>
				<br>
				<h4>FECHA: <?php echo $fac['fecha']; ?></h4>
				<br>
				<h4>TITULAR: <?php 
				$stmt = $db->prepare("SELECT titular FROM usuarios WHERE id = ?;");
        		$stmt->execute([$fac['id_usuario']]);
				$res = $stmt -> fetch(\PDO::FETCH_ASSOC);
				echo $res['titular'];
				?></h4>
				<br>
				<h4>ESTADO: <?php echo $fac['estado']; ?></h4>
				<br>
			</div>
			<div class="factura-body">
				<?php 
				$stmt = $db->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, ventas.cantidad FROM ventas INNER JOIN productos ON ventas.id_producto=productos.id WHERE ventas.id_factura = ?;");
        		$stmt->execute([$fac['id']]);
				$res = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
				foreach ($res as $p) :
				?>
				<div>
				<h5><?php 
					echo $p['nombre'];
				?></h5>
				<h6>$<?php 
					echo $p['precio'];
				?></h6>
				<?php
				if ($fac['estado'] == "PENDIENTE") :
				?>
				<div class="factura-mod">
					<button onclick="set_cant(this,<?php echo $fac['id'] ?>, <?php echo $p['id'] ?>,+1)">+</button>
					<h6 class="cant"><?php echo $p['cantidad'];?></h6>
					<button onclick="set_cant(this,<?php echo $fac['id'] ?>, <?php echo $p['id'] ?>,-1)">-</button>
				</div>
				<?php
				else :
					?>
					<h6><?php 
					echo $p['cantidad'];
				?></h6>
				<?php endif; ?>
				</div>
				<?php endforeach; ?>
				
			</div>
			<div class="factura-botones">
			<a href="facturas.php?orden=<?php echo $_GET['orden']?>&id=<?php echo $fac['id']?>&method=CANCELADO">Cancelar</a>
			<a href="facturas.php?orden=<?php echo $_GET['orden']?>&id=<?php echo $fac['id']?>&method=CONFIRMADO">Confirmar</a>
			</div>
		</div>
			<?php endforeach; ?>
	</div>




  <script>
	var facturas = {
		<?php foreach ($facturas as $fac) : ?>
			<?php echo $fac["id"] ?>: {
				<?php 
					$stmt = $db->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, ventas.cantidad FROM ventas INNER JOIN productos ON ventas.id_producto=productos.id WHERE ventas.id_factura = ?;");
					$stmt->execute([$fac['id']]);
					$res = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
					foreach ($res as $p) : ?>
					<?php echo $p["id"] ?>: <?php echo $p["cantidad"] ?>,
					<?php endforeach; ?>
			},
		<?php endforeach; ?>
	};

	<?php
	include 'pages/facturas/facturas.js';
	?>
  </script>
<?php include './pages/footer.php' ?> 

</body>
</html>