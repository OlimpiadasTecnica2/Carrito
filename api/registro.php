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
        $_POST = json_decode( file_get_contents("php://input"), true);
        $nombre_usuario = $_POST['nombre_usuario'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        //este
        //verificar si los datos estan bien
        //si el usuario existe: cancelar
        if (!isset($email, $contraseña)) {
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

        $testo = $db->prepare("INSERT INTO usuarios(email,contraseña,nombre_usuario) VALUES(?,?,?);");
        $testo->execute([$email, $contraseña,$nombre_usuario]);
        $id = $db -> lastInsertId();

        setcookie('id', $id, time() + (86400 * 30), "/");
        http_response_code(200);
        echo json_encode(["id" => $id]);
    }

} catch (\PDOException $e) {
    http_response_code(400);
    echo json_encode(["mensaje" => $e->getMessage()]);
}



?>