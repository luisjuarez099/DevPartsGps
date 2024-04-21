<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "monitoreo");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta a la base de datos para obtener la última fila
// Establecer el idioma de las fechas en español
$conexion->query("SET lc_time_names = 'es_ES'");

// Consulta a la base de datos
$sql = "SELECT 
            idmovimiento,
            localizacion, 
            DATE_FORMAT(fecha, '%W, %d de %M de %Y') as fecha, 
            DATE_FORMAT(hora, '%H:%i') as hora 
        FROM 
            movimiento 
        ORDER BY 
            idmovimiento DESC 
        LIMIT 1;";
$resultado = $conexion->query($sql);

// Obtener los datos de la última fila como un array asociativo
$ultimaFila = $resultado->fetch_assoc();

// Convertir el array asociativo a JSON y devolverlo
echo json_encode($ultimaFila);

// Cerrar la conexión a la base de datos
$conexion->close();
