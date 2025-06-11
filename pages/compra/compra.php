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
	  	<div class="card">
	  		<video class="card-img-top" loop="true" muted autoplay style width="840" height="560">
				<source src="pages/assets/img/Italy.mp4" type="video/mp4">
 			</video>
			<div class="card-body">
	        	<h5 class="card-title">ITALIA</h5>
	        	<h5>$1.500.000</h5>
				<button class="compra">AGREGAR</button>
	        	<p class="info">Pasión por el arte, la historia y la buena vida. Recorré Roma, Venecia y Florencia entre ruinas antiguas, callecitas encantadoras y sabores inolvidables.
				🍝 Incluye: alojamiento céntrico, tours culturales, clases de cocina italiana y traslados.</p>
	     	</div>
		</div>

	   <div class="card">
	    	<video class="card-img-top" loop="true" muted autoplay style width="840" height="560">
				<source src="pages/assets/img/noruega.mp4" type="video/mp4">
 			</video>
	  		<div class="card-body">
	    		<h5 class="card-title">NORUEGA</h5>
	    		<h5>$2.600.000</h5>
				<button class="compra">AGREGAR</button>
	    		<p class="info">Noruega: Naturaleza mágica y paisajes que te dejan sin aliento
				Desde los imponentes fiordos hasta la aurora boreal, Noruega es un destino de cuento.
				❄️ Incluye: navegación por fiordos, excursiones nórdicas, alojamiento con vistas panorámicas y experiencias únicas.</p>
	  		</div>
	 	</div>

	 	<div class="card">
	 		<video class="card-img-top" loop="true" muted autoplay style width="840" height="560">
				<source src="pages/assets/img/inglaterra.mp4" type="video/mp4">
 			</video>
	  		<div class="card-body">
	    		<h5 class="card-title">INGLATERRA</h5>
	    		<h5>$2.900.000</h5>
				<button class="compra">AGREGAR</button>
	    		<p class="info">Inglaterra: Historia real, ciudades vibrantes y encanto británico
				Descubrí Londres, Oxford y más entre castillos, museos, pubs y jardines victorianos.
				🎡 Incluye: entradas a atracciones, city tours, alojamiento céntrico y experiencias culturales.</p>
	  		</div>
		</div>
	</div>		
	<div class="containercompra">
		<h2></h2>
		<div id= "resumenCompra">
			<!--El resumen de compra se cargara aqui-->
		</div>
	</div>
	<script type="text/javascript" src="pages/compra/compra.js"></script><?php include '../footer.php' ?>
<?php include './pages/footer.php' ?> 

	</body>
	</html>