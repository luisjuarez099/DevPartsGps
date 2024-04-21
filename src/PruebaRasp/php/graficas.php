<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "monitoreo");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT localizacion, COUNT(*) AS cantidad FROM movimiento WHERE localizacion IN ('Puerta principal','Recamara', 'sala de estar','Comedor','Baño') GROUP BY localizacion";
$resultado = $conexion->query($sql);

// Array para almacenar los datos de movimientos
$datosMovimientos = array(
    "labels" => array(),
    "datasets" => array(
        array(
            "data" => array(),
            "label" => array(),
            "backgroundColor" => array("#ED9455", "#FFBB70", "#FFEC9E"), // Puedes personalizar los colores aquí
            "borderColor" => array("#B1A9FF", "blue", "#FF92AD"), // Puedes personalizar los colores aquí
            "borderWidth" => 1
            
        )
    )
);

// Procesar resultados de la consulta y agregarlos al array de datos
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        array_push($datosMovimientos["labels"], $fila["localizacion"]);
        array_push($datosMovimientos["datasets"][0]["data"], $fila["cantidad"]);
    }
}

// Cerrar conexión a la base de datos
$conexion->close();

// Convertir array de datos a JSON para pasarlo al JavaScript
$datosMovimientosJSON = json_encode($datosMovimientos);
echo $datosMovimientosJSON;
