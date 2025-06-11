<?php
header('Content-Type: application/json');


try {
    include 'conexion.php';

    function carrito_PUT()
    {
        include 'conexion.php';
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
        $stmt->execute([$data['cantidad'], $_COOKIE['id'], $data['producto_id']]);
        http_response_code(200);
        echo json_encode(['mensaje' => 'Cantidad modificada']);
    }

    $method = $_SERVER['REQUEST_METHOD'];
    if (!isset($_COOKIE['id'])) {
        http_response_code(401);
        echo json_encode(['mensaje' => "Not logged in"]);
        return;
    }

    if ($method === 'GET') {
        $usuario_id = $_COOKIE['id'];
        $stmt = $db->prepare("SELECT c.id, p.nombre, p.imagen, p.precio, c.cantidad FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = ?");
        $stmt->execute([$usuario_id]);
        http_response_code(200);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } elseif ($method === 'POST') {
        //Verificar si ya existe
        $stmt = $db->prepare("SELECT * FROM carrito WHERE id_producto = ?;");
        $stmt->execute([$data['producto_id']]);
        if ($stmt -> fetch(\PDO::FETCH_ASSOC)) {
            carrito_PUT();
            return;
        }
        //Solo json en el body de la peticion, sin form data
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$_COOKIE['id'], $data['producto_id'], $data['cantidad']]);
        http_response_code(200);
        echo json_encode(['mensaje' => 'Producto agregado al carrito']);

    } elseif ($method === 'PUT') {
        carrito_PUT();
    }
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['mensaje' => $e->getMessage()]);
}
?>