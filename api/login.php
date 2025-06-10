<?php
header('Content-Type: application/json');
try{
	$db = new \PDO("sqlite:base.db");

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$email = $_POST['email'];
	$contrasena = $_POST['contrasena'];

	if(!isset($email) || !isset($contrasena)){
		echo "Empty values";
		return;	
	}
	$stm = $db -> prepare("SELECT id,titular FROM usuarios WHERE email = :email AND contrasena = :contrasena;");
	$stm -> execute([':email' => $email, ':contrasena' => $contrasena]);
	$res = $stm -> fetch(\PDO::FETCH_ASSOC);
	$id = $res['id'];
	$titular = $res['titular'];	
	setcookie('id',$id, time() + (86400 * 30) ,"/");
	echo $titular;
	return;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		if (!isset($_COOKIE['id'])){
			echo 'Not logged in';
			return;
		}
			
	$stm = $db -> prepare("SELECT titular FROM usuarios WHERE id = :id;");
	$stm -> execute([':id' => $_COOKIE['id']]);
	echo $stm -> fetch(\PDO::FETCH_ASSOC)['titular'];
	return;
	}	
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		if(!isset($_COOKIE['id'])){
				echo "Not logged in";
				return;
		}
		unset($_COOKIE['id']);
		setcookie('id', '', -1, '/');
	       echo "Correct";	
	}
}catch (\PDOException $e){
	echo $e -> getMessage();
}

?>
