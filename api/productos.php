<?php
header('Content-Type: application/json');
try {
    include 'conexion.php';

    $stmt = $db->query("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    http_response_code(200);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(["mensaje" => $e->getMessage()]);
}
?>