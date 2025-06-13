<?php
    include 'conexion.php';

    include '../admin/admin_user.php';
    if (!isset($_COOKIE['id'])){
        http_response_code(400);
        echo json_encode(["mensaje" => "User not logged in"]);
        return;
    }

    if (!isset($_POST['id'])){
        http_response_code(400);
        echo json_encode(["mensaje" => "Empty values"]);
        return;
    }

    $stmt = $db->prepare("SELECT email, contraseña FROM usuarios WHERE id = ?");
    $stmt -> execute([$_COOKIE['id']]);
    $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($usuario['email'] != $admin_email || $usuario['contraseña'] != $admin_password){
        http_response_code(400);
        echo json_encode(["mensaje" => "Not an admin user"]);
        return;
    }
    $stmt = $db->prepare("DELETE FROM productos WHERE id = ?");
    $stmt -> execute([$_POST['id']]);
    http_response_code(200);
    echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
    header("Location: /compra.php");
    die();
?>