<?php
header('Content-Type: application/json');
try {
    include 'conexion.php';
    $usuario_id = $_COOKIE['id'];
    if (!isset($usuario_id)) {
        http_response_code(400);
        echo json_encode(['mensaje' => "Not logged in"]);
    }

    $stmt = $db->prepare("SELECT titular, email FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT productos.nombre, productos.precio, carrito.cantidad FROM carrito INNER JOIN productos on carrito.id_producto=productos.id WHERE carrito.id_usuario = ?");
    $stmt->execute([$usuario_id]);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /*foreach ($carrito as $item) {
        $stmt = $db->prepare("INSERT INTO compras (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $item['producto_id'], $item['cantidad']]);
    }*/

    //Hacer calculo de precio y crear un mail pre procesado, ej:
    $factura =
        "FACTURA
Remitente: sectorprofesional@gmail.com
Destinatario: {$usuario['email']} ({$usuario['titular']})

PRODUCTOS\n";
    $subtotal = 0;
    $total = 0;
    foreach ($productos as $p) {
        $factura .= "Nombre: {$p['nombre']} Precio: {$p['precio']} Cantidad: {$p['cantidad']}";
        $subtotal += $p['precio'];
        $total += $p['precio'] * $p['cantidad'];
    }
    $factura .=
        "\n
Subtotal = {$subtotal}
Total = {$total}

Gracias por su compra!
";
    //TODO: Enviar mail a ambos

    $stmt = $db->prepare("DELETE FROM carrito WHERE id_usuario = ?");
    $stmt->execute([$usuario_id]);

    echo json_encode(['mensaje' => $factura]);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['mensaje' => $e->getMessage()]);
}
?>