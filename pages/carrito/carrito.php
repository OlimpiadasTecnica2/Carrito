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
  		<div class="itemCARRITO" data-precio="100">
    <div class="info">
      <strong>Paquete Italia</strong><br>
      $<span class="precio">1.500.000</span>
    </div>
    <div class="contador">
      <button class="menos">-</button>
      <span class="cantidad">0</span>
      <button class="mas">+</button>
    </div>
  </div>

  <div class="item" data-precio="150">
    <div class="info">
      <strong>Paquete Noruega</strong><br>
      $<span class="precio">2.600.000</span>
    </div>
    <div class="contador">
      <button class="menos">-</button>
      <span class="cantidad">0</span>
      <button class="mas">+</button>
    </div>
  </div>

  <div class="resumen">
    Subtotal: $<span id="subtotal">0</span><br>
    Total: $<span id="total">0</span>
    <button class="comprar">Comprar</button>
  </div>
</div>

<script type="text/javascript" src="carrito.js"></script>

<?php include './pages/footer.php' ?> 

</body>
</html>
		
