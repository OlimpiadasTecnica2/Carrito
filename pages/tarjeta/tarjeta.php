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


<form id="comprarForm" action="carrito.php" method="POST">
	<label for="metodo">Metodo de pago</label>
    <select name="metodo" id="metodo" onfocus = "this.selectedIndex = -1;" selectedIndex="-1" onchange="change_metodo();">
        <option value="debito">Tarjeta de debito</option>
        <option value="credito">Tarjeta de credito</option>
        <option value="transferencia">Transferencia</option>
    </select>
    
    <div id="metodo_cont">

    </div>
    
    <div class="consumidor_form">
	<label for="cliente_final">A nombre de otro consumidor</label>
    <input type="checkbox" name="consumidor_final" id="consumidor_final" >
	</div>

    <div id="consumidor_cont">

    </div>

	<button type="submit">Comprar</button>
</form>
 
  <script type="text/javascript" src="pages/tarjeta/tarjeta.js"></script>
<?php include './pages/footer.php' ?> 

</body>
</html>