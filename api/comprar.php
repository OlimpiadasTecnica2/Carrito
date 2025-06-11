
<?php
header('Content-Type: application/json');
try{
include 'conexion.php';


$data = json_decode(file_get_contents("php://input"), true);
$usuario_id = $data['usuario_id'];

$stmt = $db->prepare("SELECT producto_id, cantidad FROM carrito WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*foreach ($carrito as $item) {
    $stmt = $db->prepare("INSERT INTO compras (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->execute([$usuario_id, $item['producto_id'], $item['cantidad']]);
}*/

$stmt = $db->prepare("DELETE FROM carrito WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);

echo json_encode(['mensaje' => 'Compra realizada con éxito']);
}
catch(PDOException $e){
    echo json_encode(['mensaje'=> $e->getMessage()]);
}
?>
