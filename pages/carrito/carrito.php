<!DOCTYPE html>
<html>
<head>	
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="./pages/styles.css">
</head>

<body>
<?php if(isset($_COOKIE['id'])) : ?>
	<?php include './pages/header.php' ?>
  <div class="main-cont">

	<div class="carrito">

    <?php 
      $db = new \PDO("sqlite:api/base.db");
      $usuario_id = $_COOKIE['id'];
      $stmt = $db->prepare("SELECT productos.id, productos.nombre, productos.imagen, productos.precio, carrito.cantidad FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = ?");
      $stmt->execute([$usuario_id]);
      $res = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
      $total = 0;
      $subtotal = 0;
      if (sizeof($res) == 0) { echo "<h1>No tienes productos en el carrito</h1>"; }
      foreach ($res as $item) :
    ?>
    <?php $total += $item['precio'] * $item['cantidad'];
    $subtotal += $item['precio'];
    ?>
  		<div class="item">
        <img src="<?php echo $item['imagen']; ?>" alt="" srcset="">
        <div class="info">
        <strong><?php echo $item['nombre']; ?></strong><br>
        $<span class="precio"><?php echo $item['precio']; ?></span>
    </div>
    <div class="contador" id="<?php echo $item['id']; ?>">
      <button class="menos" onclick="mod(this,-1,<?php echo $item['id']; ?>);">-</button>
      <span class="cant"><?php echo isset($item['cantidad']) ? $item['cantidad'] : 0; ?></span>
      <button class="mas" onclick="mod(this,+1,<?php echo $item['id']; ?>);">+</button>
    </div>
  </div>
  <?php endforeach ?>

  <div class="resumen">
    Subtotal: $<span id="subtotal"><?php echo $subtotal; ?></span><br>
    Total: $<span id="total"><?php echo $total; ?></span>
      <button class="comprar" onclick="generar_factura()">Comprar</button>
    </div>
</div>

<div id="factura" class="hidden" ></div>
</div>

<script type="text/javascript">
var productos = [
  <?php foreach($res as $item) : ?>
    {
    id: <?php echo $item['id']; ?>,
    nombre: '<?php echo $item['nombre']; ?>',
    precio: <?php echo $item['precio']; ?>,
    cantidad: <?php echo $item['cantidad']; ?>,
    },
    <?php endforeach; ?>
];
<?php include 'pages/carrito/carrito.js'; ?>

</script>
<?php 
    else : include './pages/login/login.php';
endif; 
?>
<?php if(isset($_COOKIE['id'])) {include './pages/footer.php';} ?> 

</body>
</html>
		
