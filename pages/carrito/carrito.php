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
	<div class="carrito">

    <?php 
      $db = new \PDO("sqlite:api/base.db");
      $usuario_id = $_COOKIE['id'];
      $stmt = $db->prepare("SELECT productos.id, productos.nombre, productos.imagen, productos.precio, carrito.cantidad FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = ?");
      $stmt->execute([$usuario_id]);
      $res = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
      $total = 0;
      $subtotal = 0;
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
      <button class="menos" onclick="mod(this,-1);">-</button>
      <span id="cant"><?php echo isset($item['cantidad']) ? $item['cantidad'] : 0; ?></span>
      <button class="mas" onclick="mod(this,-1);">+</button>
    </div>
  </div>
  <?php endforeach ?>

  <div class="resumen">
    Subtotal: $<span id="subtotal"><?php echo $subtotal; ?></span><br>
    Total: $<span id="total"><?php echo $subtotal; ?></span>
    <form action="api/comprar.php" method="GET">
      <button class="comprar" type="submit">Comprar</button>
      </form>
    </div>
</div>

<script type="text/javascript">
var productos = [
  <?php foreach($res as $item) : ?>
    {
    id: <?php echo $item['id']; ?>,
    nombre: <?php echo $item['nombre']; ?>,
    cantidad: <?php echo $item['cantidad']; ?>,
    }
    <?php endforeach; ?>
];

function mod(ref, dif){
  const cant = ref.parentElement().getElementById('cant');
  var cantidad = 0;
  var index = 0;
  for (const [i,p] of productos.entries())
{
  if (p.id == ref.parentElement().id){
    cantidad = p.cantidad;
    index = i;
    break;
  }
}
  cantidad += dif;
  if (cantidad < 0){
    return;
  }
  productos[index].cantidad = cantidad;
  fetch ('api/carrito.php',
    {
      method: "PUT",
      headers: {'content-type': 'application/json'},
      body: JSON.stringify({
        'cantidad': cantidad,
        'producto_id': ref.id,
      })
    }
  ).then((res) => res.json()).then((json) => console.log(json)); 
  cant.innerHTML = cantidad;
}

</script>

<?php include './pages/footer.php' ?> 

</body>
</html>
		
