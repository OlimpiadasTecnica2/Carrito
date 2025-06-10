<?php 

//Inputs:
//codigo de seguridad
//fecha de  vencimiento
//contraseña
//email
//nombre del titular
//direccion
//cookie: ID del usuario / Mensaje de error
//alta? debo aaceder a la bd ?
//el id se obtine mediante?

try{
    $db = new \PDO("sqlite:base.db");
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $titular = $_POST['titular'];
    $email = $_POST['email'];//este
    $contraseña= $_POST['contraseña'];
    $numero_tarjeta= $_POST['numero_tarjeta'];
    $fecha_vencimiento= $_POST['fecha_vencimiento'];
    $cvv = $_POST['cvv'];
    $direccion = $_POST['direccion'];
    //verificar si los datos estan bien
    //si el usuario existe: cancelar
    if (!isset($email) || !isset($titular) || !isset($contraseña) || !isset($numero_tarjeta) || !isset($cvv) || !isset($direccion) || !isset($fecha_vencimiento)){
        echo "Empty values";
        return;
    }
    $testa= $db -> prepare("SELECT * FROM usuarios WHERE email = :email;");
    $testa -> execute([':email' => $email]);
    $size = $testa -> fetch(\PDO::FETCH_ASSOC);

    if ($size){
	    echo "The user already exists";
	    echo $size;
        return;
    }

    $testo = $db -> prepare("INSERT INTO usuarios(email,contrasena,titular,numero_tarjeta,fecha_vencimiento,cvv,direccion) VALUES(:email,:contrasena,:titular,:numero_tarjeta,:fecha_vencimiento,:cvv,:direccion);");
    $testo -> execute([':email' => $email, ':contrasena' => $contraseña,':titular' => $titular,':numero_tarjeta' => $numero_tarjeta,':fecha_vencimiento' => $fecha_vencimiento,':cvv' => $cvv,':direccion' => $direccion]);


    $testo = $db -> prepare("SELECT (id) FROM usuarios WHERE email = :email AND contrasena = :contrasena;");
    $testo -> execute([':email' => $email, ':contrasena' => $contraseña]);
	   $id = $testo -> fetch(\PDO::FETCH_ASSOC)['id'];

    setcookie('id',$id, time() + (86400 * 30) ,"/");
    echo $id;


    }
     
} catch (\PDOException $e){
	echo $e -> getMessage();
}



?>
