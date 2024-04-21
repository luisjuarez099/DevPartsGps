<?php
// Este archivo se llama 'actualizar.php'

// Establecer conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "monitoreo");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Consulta para obtener la cantidad de inserciones en la base de datos
$sql = "SELECT COUNT(*) AS total FROM movimiento";
$resultado = $conexion->query($sql);

// Verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $cantidad_actual = $fila["total"]; // Cantidad actual de inserciones en la tabla
} else {
    $cantidad_actual = 0; // Si no se encontraron registros, la cantidad es cero
}

// Verificar si la variable de sesión ya está definida
if (!isset($_SESSION['cantidad_inserciones'])) {
    $_SESSION['cantidad_inserciones'] = $cantidad_actual; // Asignar la cantidad actual a la variable de sesión
} else {
    // Comparar la cantidad actual con la anterior
    if ($_SESSION['cantidad_inserciones'] != $cantidad_actual) {
        $_SESSION['cantidad_inserciones'] = $cantidad_actual; // Actualizar la variable de sesión con el nuevo valor
    }
}

// Devolver la cantidad actual de inserciones
echo $_SESSION['cantidad_inserciones'];

?>
