<?php 

try {
	include 'conexion.php';
	include '../admin/admin_user.php';
	$sql = file_get_contents("productos.sql");
	if ($sql){$db -> exec($sql);}
	if (!isset($_COOKIE['id'])) {
		echo json_encode(["mansaje" => "Not logged in"]);
		return;
	}
	$stmt = $db -> prepare("SELECT email, contraseña FROM usuarios WHERE id = ?;");
	$stmt -> execute([$_COOKIE['id']]);
	$usuario = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
	if ($usuario['email'] == $admin_email && $usuario['contraseña'] == $admin_password){
			if ($_SERVER['REQUEST_METHOD'] == "POST"){
		//$_POST = json_decode(file_get_contents('php://input'),true);

		$nombre = $_POST['nombre'];
		$imagen = $_POST['imagen'];
		$precio = $_POST['precio'];

		$stm = $db -> prepare("INSERT INTO productos(nombre,imagen,precio) VALUES(:nombre,:imagen,:precio);");
		$stm -> execute([':nombre' => $nombre, ':imagen' => $imagen, ':precio' => $precio]);
    	echo json_encode(['id' => $db->lastInsertId()]);
		return;
	}
	}

} catch (\PDOException $e){
	echo $e-> getMessage();
}

?>
