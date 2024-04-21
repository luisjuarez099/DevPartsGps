<?php

try {

	// Verificar si se ha enviado el formulario
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//conexion a base de datos
		$conexion = new mysqli("localhost", "root", "", "monitoreo");

		// Check connection
		if (mysqli_connect_errno()) {
			echo "Base de datos no responde";
		}
		if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) && isset($_POST["contrasena"]) && !empty($_POST["contrasena"])) {
			$usuario = mysqli_real_escape_string($con, $_POST["usuario"]);
			$contrasena = mysqli_real_escape_string($con, $_POST["contrasena"]);
		} else {
			die("Ingrese un usuario y/o contraseña");
		}
		// Consulta SQL para verificar el usuario y contraseña
		$sql = "SELECT idUsuarios FROM `usuarios` where user = '$usuario' and pass = '$contrasena'";

		$result = $con->query($sql);

		// Verificar si se encontró un usuario con esa contraseña
		if ($result->num_rows > 0) {
			echo "success";
		} else {
			die("no encontro nada en la consulta.");
		}
	}
} catch (Exception $ex) {
	$mensaje =  "Algo Malio sal";
}
