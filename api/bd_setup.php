<?php 

try {
	include 'conexion.php';
	$sql = file_get_contents("productos.sql");
	if ($sql){$db -> exec($sql);}
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
