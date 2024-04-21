// Obtener los datos del servidor PHP
fetch('../php/graficaDispercion.php')
    .then(response => response.json())
    .then(data => {
        // Crear el gráfico de dispersión con los datos recibidos
        createScatterChart(data);
    })
    .catch(error => console.error('Error al obtener los datos:', error));

function createScatterChart(data) {
    // Datos para el gráfico de dispersión
    const scatterData = {
        datasets: [{
            label: 'Paso/Nopaso',
            data: data.map(point => ({ x: point.idmovimiento, y: point.status })),
            backgroundColor: 'red', // Color de los puntos
        }]
    };

    // Opciones para el gráfico de dispersión
    const options = {
        scales: {
            x: {
                type: 'linear',
                position: 'bottom'
            },
            y: {
                type: 'linear',
                position: 'left'
            }
        }
    };

    // Obtener el contexto del lienzo
    const ctx = document.getElementById('myScatterChart').getContext('2d');

    // Crear el gráfico de dispersión
    const scatterChart = new Chart(ctx, {
        type: 'scatter',
        data: scatterData,
        options: options
    });
}
