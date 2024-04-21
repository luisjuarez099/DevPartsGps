<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "monitoreo");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT idmovimiento, status, fecha, hora FROM movimiento LIMIT 10"; // Limitar a 10 resultados
$resultado = $conexion->query($sql);

// Array para almacenar los datos de movimientos
$datosMovimientos = array();

// Procesar resultados de la consulta y agregarlos al array de datos
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        array_push($datosMovimientos, $fila);
    }
}

// Cerrar conexión a la base de datos
$conexion->close();

// Convertir array de datos a JSON y enviarlo como respuesta
echo json_encode($datosMovimientos);
