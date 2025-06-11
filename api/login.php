<?php
header('Content-Type: application/json');
try {
	include 'conexion.php';

		$_POST = json_decode( file_get_contents("php://input"), true);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $_POST['email'];
		$contraseña = $_POST['contraseña'];

		if (!isset($email,$contraseña)) {
			http_response_code(400);
			echo json_encode(['mensaje' => 'Empty values']);
			return;
		}
		$stm = $db->prepare("SELECT id,titular FROM usuarios WHERE email = ? AND contraseña = ?;");
		$stm->execute([$email, $contraseña]);
		$res = $stm->fetch(\PDO::FETCH_ASSOC);
		if (!$res){
			http_response_code(400);
			echo json_encode(['mensaje' => 'User not registed']);
			return;
		}
		$id = $res['id'];
		$titular = $res['titular'];
		setcookie('id', $id, time() + (86400 * 30), "/");
		http_response_code(200);
		echo json_encode(['titular' => $titular, 'email' => $email]);
		return;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (!isset($_COOKIE['id'])) {
			http_response_code(400);
			echo json_encode(['mensaje' => 'Not logged in']);
			return;
		}

		$stm = $db->prepare("SELECT titular, email FROM usuarios WHERE id = :id;");
		$stm->execute([':id' => $_COOKIE['id']]);
		$res = $stm->fetch(\PDO::FETCH_ASSOC);
		echo json_encode(['titular' => $res['titular'], 'email'=> $res['email']]);
		return;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		if (!isset($_COOKIE['id'])) {
			http_response_code(400);
			echo json_encode(['mensaje' => 'Not logged in']);
			return;
		}
		unset($_COOKIE['id']);
		setcookie('id', '', -1, '/');
		http_response_code(200);
		echo json_encode(['mensaje' => 'Correct']);
	}
} catch (\PDOException $e) {
	http_response_code(400);
	echo json_encode(["mensaje" => $e->getMessage()]);
}

?>