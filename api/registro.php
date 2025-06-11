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

try {
    include 'conexion.php';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $titular = $_POST['titular'];
        $email = $_POST['email'];//este
        $contraseña = $_POST['contraseña'];
        $numero_tarjeta = $_POST['numero_tarjeta'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $cvv = $_POST['cvv'];
        $direccion = $_POST['direccion'];
        //verificar si los datos estan bien
        //si el usuario existe: cancelar
        if (!isset($email, $titular, $contraseña, $numero_tarjeta, $cvv, $direccion, $fecha_vencimiento)) {
            http_response_code(400);
    echo json_encode(["mensaje" => "Empty values"]);
            return;
        }
        $testa = $db->prepare("SELECT * FROM usuarios WHERE email = ?;");
        $testa->execute([$email]);
        $size = $testa->fetch(\PDO::FETCH_ASSOC);

        if ($size) {
            http_response_code(400);
    echo json_encode(["mensaje" => "The user already exists"]);
            return;
        }

        $testo = $db->prepare("INSERT INTO usuarios(email,contraseña,titular,numero_tarjeta,fecha_vencimiento,cvv,direccion) VALUES(?,?,?,?,?,?,?);");
        $testo->execute([$email, $contraseña, $titular, $numero_tarjeta, $fecha_vencimiento, $cvv, $direccion]);


        $testo = $db->prepare("SELECT (id) FROM usuarios WHERE email = ? AND contraseña = ?;");
        $testo->execute([$email, $contraseña]);
        $id = $testo->fetch(\PDO::FETCH_ASSOC)['id'];

        setcookie('id', $id, time() + (86400 * 30), "/");
        http_response_code(200);
        echo json_encode(["id" => $id]);


    }

} catch (\PDOException $e) {
    http_response_code(400);
    echo json_encode(["mensaje" => $e->getMessage()]);
}



?>