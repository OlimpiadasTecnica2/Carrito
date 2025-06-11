<?php
header('Content-Type: application/json');


try {
    include 'conexion.php';
    function carrito_PUT($db)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
        $stmt->execute([$data['cantidad'], $_COOKIE['id'], $data['producto_id']]);
        http_response_code(200);
        echo json_encode(['mensaje' => 'Cantidad modificada']);
        return;
    }

    $method = $_SERVER['REQUEST_METHOD'];
    if (!isset($_COOKIE['id'])) {
        http_response_code(401);
        echo json_encode(['mensaje' => "Not logged in"]);
        return;
    }

    if ($method === 'GET') {
        $usuario_id = $_COOKIE['id'];
        $stmt = $db->prepare("SELECT productos.nombre, productos.imagen, productos.precio, carrito.cantidad FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = ?");
        $stmt->execute([$usuario_id]);
        http_response_code(200);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } elseif ($method === 'POST') {
        //Verificar si ya existe
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $db->prepare("SELECT * FROM carrito WHERE id_producto = ? AND id_usuario = ?;");
        $stmt->execute([$data['producto_id'], $_COOKIE['id']]);
        $res = $stmt -> fetch(\PDO::FETCH_ASSOC);
        if ($res) {
            carrito_PUT($db);
            return;
        }
        //Solo json en el body de la peticion, sin form data
        $stmt = $db->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$_COOKIE['id'], $data['producto_id'], $data['cantidad']]);
        http_response_code(200);
        echo json_encode(['mensaje' => 'Producto agregado al carrito']);

    } elseif ($method === 'PUT') {
        carrito_PUT($db);
    }
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['mensaje' => $e->getMessage()]);
}
?>