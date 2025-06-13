<?php
header('Content-Type: application/json');


try {
    include 'conexion.php';
    function facturas_PUT($db)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("UPDATE ventas SET cantidad = ? WHERE id_factura = ? AND id_producto = ?");
        $stmt->execute([$data['cantidad'], $data['id_factura'], $data['producto_id']]);
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
        //api/facturas.php?id_factura=1
        if (isset( $_GET["id_factura"],$_GET["orden"] )) {
            $stmt = $db->prepare("SELECT facturas.id, facturas.fecha, facturas.id_usuario, facturas.estado, ventas.id_producto, ventas.cantidad FROM ventas INNER JOIN facturas ON ventas.id_factura = facturas.id WHERE ventas.id_factura = ? ORDER BY ?;");
            $stmt->execute([$_GET["id_factura"],$_GET["orden"]]);
            http_response_code(200);
        echo json_encode($stmt->fetch(\PDO::FETCH_ASSOC));
        return;
        }
        else{
            $stmt = $db->prepare("SELECT facturas.id, facturas.fecha , facturas.id_usuario, facturas.estado, ventas.id_producto, ventas.cantidad FROM ventas INNER JOIN facturas ON ventas.id_factura = facturas.id WHERE facturas.id_usuario = ?;");
            $stmt->execute([$usuario_id]);
            http_response_code(200);
        echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
        return;
        }
        
        
    } elseif ($method === 'POST') {
        //Verificar si ya existe
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $db->prepare("UPDATE factura SET estado = ? WHERE id_factura = ? AND id_usuario = ?;");
        $stmt->execute([$data['estado'], $data['id_factura'], $_COOKIE['id']]);
        http_response_code(200);
        echo json_encode(['mensaje' => 'Estado de factura modificada']);

    } elseif ($method === 'PUT') {
        facturas_PUT($db);
    }
} catch (\PDOException $e) {
    http_response_code(400);
    echo json_encode(['mensaje' => $e->getMessage()]);
}
?>