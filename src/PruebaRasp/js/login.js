$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        // Evitamos que el formulario se envíe de forma predeterminada
        event.preventDefault();

        // Obtenemos los valores de los campos del formulario
        var usuario = $('#Usuario').val();
        var contrasena = $('#Contrasena').val();

        // Enviamos los datos del formulario al archivo PHP usando AJAX
        $.ajax({
            type: 'POST',
            url: '../php/login.php',
            data: {usuario: usuario, contrasena: contrasena},
            success: function(response) {
                console.log(response)
                if (response.trim() === "success") {
                    // Redirigir al usuario a otra página
                    window.location.href = "https://localhost/src/PruebaRasp/html/main.html";
                } else {
                    $('#mensaje-error').text(response);
                }
            }
        });
    });
});
