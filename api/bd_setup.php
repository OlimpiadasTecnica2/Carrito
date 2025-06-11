<?php 

try {
	include 'conexion.php';
	$db -> exec("CREATE TABLE IF NOT EXISTS usuarios (id INTEGER PRIMARY KEY, titular TEXT, email TEXT, contraseña TEXT, numero_tarjeta INTEGER, fecha_vencimiento INTEGER, cvv INTEGER, direccion TEXT);");
	$db -> exec("CREATE TABLE IF NOT EXISTS productos (id INTEGER PRIMARY KEY, nombre TEXT, descripcion TEXT, imagen TEXT, precio NUMBER);");
	$db -> exec("CREATE TABLE IF NOT EXISTS carrito (id_usuario INTEGER, id_producto INTEGER, cantidad INTEGER);");

	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		//$_POST = json_decode(file_get_contents('php://input'),true);

		$nombre = $_POST['nombre'];
		$imagen = $_POST['imagen'];
		$precio = $_POST['precio'];

		$stm = $db -> prepare("INSERT INTO productos(nombre,imagen,precio) VALUES(:nombre,:imagen,:precio);");
		$stm -> execute([':nombre' => $nombre, ':imagen' => $imagen, ':precio' => $precio]);
	}

} catch (\PDOException $e){
	echo $e-> getMessage();
}

?>
