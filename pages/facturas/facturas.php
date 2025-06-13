<!DOCTYPE html>
<html>
	<head>	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Facturas</title>
	<link rel="stylesheet" type="text/css" href="./pages/styles.css">
</head>

<body>

<?php include './pages/header.php' ?> 

<header class="submenu">
<a href="facturas.php?orden=fecha<?php if(isset($_GET['historico'])) { echo '&historico=true'; }?>">Ordenar por Fecha</a>	
	<a href="facturas.php?orden=estado<?php if(isset($_GET['historico'])) { echo '&historico=true'; }?>">Ordenar por Estado</a>
<?php include 'admin/admin_user.php';
	 $db = new \PDO("sqlite:api/base.db");
	 $usuario_id = $_COOKIE['id'];
	 $stmt = $db->prepare("SELECT nombre_usuario, email, contraseña FROM usuarios WHERE id = ?;");
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
	<h2>Administrador</h2>
	<a href="facturas.php?orden=id_usuario<?php if(isset($_GET['historico'])) { echo '&historico=true'; }?>">Ordenar por Cuentas</a>
	<?php else : ?>  
	<h2><?php echo $res['nombre_usuario']; ?></h2>
	<?php endif; ?>
	<a href="facturas.php?<?php if(!isset($_GET['historico'])) { echo 'historico=true'; }?>">
	<?php if(!isset($_GET['historico'])) { echo '-> Historico'; } else { echo '-> Pendientes'; }?>	</a>

</header>
	
	<div class="facturas_seleccion">
		<?php
		$clause = ""; 
		$params = [];
		if(isset($_GET['historico'])){
		$clause = "WHERE estado == 'CONFIRMADO'"; 
		}else{
			$clause = "WHERE estado <> 'CONFIRMADO'";
		}

		if ($res['email'] == $admin_email && $res['contraseña'] == $admin_password){
			$query = "SELECT id, fecha , id_usuario, estado FROM facturas ";
		}else{
			$query = "SELECT id, fecha , id_usuario, estado FROM facturas ";
			$clause .= " AND id_usuario = ? ";
				$params = [$usuario_id];
		}
		$stmt = $db->prepare("{$query} {$clause} ORDER BY facturas.{$_GET['orden']} DESC;");
		$stmt->execute($params);
		$facturas = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
		foreach ($facturas as $fac) :
		?>
		<div class="factura-marco">
			<div class="factura-head">
				<h4>FACTURA NUMERO:<?php echo $fac['id']; ?></h4>
				<br>
				<h4>FECHA: <?php echo $fac['fecha']; ?></h4>
				<br>
				<h4>nombre: <?php 
				$stmt = $db->prepare("SELECT nombre_usuario FROM usuarios WHERE id = ?;");
        		$stmt->execute([$fac['id_usuario']]);
				$res = $stmt -> fetch(\PDO::FETCH_ASSOC);
				echo $res['nombre_usuario'];
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
				?> USD</h6>
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
