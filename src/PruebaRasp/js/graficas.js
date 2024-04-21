// Función para obtener y actualizar los datos de la gráfica
function actualizarGrafica() {
    fetch('../php/graficas.php')
        .then(response => response.json())
        .then(data => {
            // Actualizar la gráfica con los nuevos datos
            myChart.data = data;
            myChart.update();
        })
        .catch(error => console.error('Error al obtener los datos:', error));
}

// Configuración del gráfico
const opciones = {
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                color: 'white' // Cambiar color del texto de los ejes y
            }
        },
        x: {
            ticks: {
                color: 'white' // Cambiar color del texto de las etiquetas x
            }
        }
    }
};


let cantidadServidor = 0;
function actualizarGraficaConNuevosDatos() {
    fetch('../php/actualizar.php')
        .then(response => response.text())
        .then(data => {
            // Convertir la respuesta del servidor a un número entero
            const cantidadActual = parseInt(data);
            // Actualizar la variable global con el nuevo valor
            if (cantidadServidor === 0) {
                cantidadServidor = cantidadActual;
            }
            if (cantidadActual > cantidadServidor) {
                // Actualizar la gráfica u otro contenido con los nuevos datos
                actualizarGrafica();
                actualizarTabla();
                cantidadServidor = cantidadActual; // Actualizar la variable global con el nuevo valor
            }
        })
        .catch(error => console.error('Error al obtener los datos actualizados:', error));
}

// Obtener el contexto del lienzo
const ctx = document.getElementById('myChart').getContext('2d');

// Configurar fuentes globales para el texto blanco
Chart.defaults.font.color = 'white';

// Crear la gráfica inicial
let myChart;
fetch('../php/graficas.php')
    .then(response => response.json())
    .then(data => {
        // Crear el gráfico con los datos recibidos
        myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: opciones
        });

        // Iniciar el polling para actualizar la gráfica cada 5 segundos (5000 milisegundos)
        setInterval(actualizarGraficaConNuevosDatos, 1000);
    })
    .catch(error => console.error('Error al obtener los datos:', error));

$(document).ready(function () {
    $('#tabla').DataTable({
        "ajax": {
            "url": "../php/tabla.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idmovimiento" },
            { "data": "localizacion" },
            { "data": "fecha" },
            { "data": "hora" }
        ],
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

function actualizarTabla() {
    fetch('../php/ultimafila.php')
        .then(response => response.json())
        .then(data => {

            // Agregar la última fila a la DataTable
            $('#tabla').DataTable().row.add(data).draw();
        })
        .catch(error => console.error('Error al obtener la última fila:', error));
}
