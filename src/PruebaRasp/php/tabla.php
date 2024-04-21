<?php
// Conexión a la base de datos
//cambiar la ip a la que tenga la raspberry
$conexion = new mysqli("localhost", "root", "", "monitoreo");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

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
            idmovimiento desc";
$resultado = $conexion->query($sql);

// Convertir resultados a un array
$datos = array();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}

// Cerrar conexión a la base de datos
$conexion->close();

// Devolver los datos como JSON
echo json_encode($datos);
?>
