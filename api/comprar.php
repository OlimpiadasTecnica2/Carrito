<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', '1');
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

    $stmt = $db->prepare("SELECT productos.id, productos.nombre, productos.precio, carrito.cantidad FROM carrito INNER JOIN productos on carrito.id_producto=productos.id WHERE carrito.id_usuario = ?");
    $stmt->execute([$usuario_id]);
    $productos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $stmt = $db->prepare("INSERT INTO facturas(id_usuario, estado) VALUES(?,?);");
    $stmt->execute([$usuario_id,"PENDIENTE"]);
    $factura_id = $db->lastInsertId();
    foreach ($productos as $item) {
        $stmt = $db->prepare("INSERT INTO ventas VALUES (?, ?, ?)");
        $stmt->execute([$factura_id, $item['id'], $item['cantidad']]);
    }
    $fecha = date('Y-m-d H:i:s');
    //Hacer calculo de precio y crear un mail pre procesado, ej:
    $factura =
        "FACTURA NUMERO: $factura_id
        Fecha: $fecha
Remitente: sectorprofesional@gmail.com
Destinatario: {$usuario['email']} ({$usuario['titular']})

PRODUCTOS\n-------------------------\n";
    $subtotal = 0;
    $total = 0;
    foreach ($productos as $p) {
        $factura .= "Nombre: {$p['nombre']} | Precio: {$p['precio']} | Cantidad: {$p['cantidad']}";
        $subtotal += $p['precio'];
        $total += $p['precio'] * $p['cantidad'];
        $factura .="\n-------------------------\n";
    }
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['metodo'],$data['direccion'],$data['titular'])){
        $factura .= "\n METODO: {$data['metodo']}
        TITULAR: {$data['titular']}
        DIRECCION: {$data['direccion']}";    
    }
    if (isset($data['nombre'],$data['apellido'],$data['dni'])){
        $factura .= "
        CONSUMIDOR FINAL
        NOMBRE: {$data['nombre']}
        APELLIDO: {$data['apellido']}
        DNI: {$data['apellido']}";
    }

    $factura .=
        "\n
Subtotal = {$subtotal}
Total = {$total}

Gracias por su compra!
";

$factura = wordwrap($factura,70);

$headers = "From: noreply@carrito.boldwave.com\r\n";
        $headers .= "Reply-To: sectorprofesional@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    //TODO: Enviar mail a ambos
    mail($usuario['email'],"Factura",$factura,$headers);
    mail("sectorprofesional@gmail.com","Factura",$factura,$headers);
    
    $stmt = $db->prepare("DELETE FROM carrito WHERE id_usuario = ?");
    $stmt->execute([$usuario_id]);

    echo json_encode(['mensaje' => $factura]);
} catch (\PDOException $e) {
    http_response_code(400);
    echo json_encode(['mensaje' => $e->getMessage()]);
}
?>