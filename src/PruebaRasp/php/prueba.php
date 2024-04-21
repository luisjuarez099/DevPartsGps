import RPi.GPIO as GPIO
import mysql.connector
from datetime import datetime
import time

GPIO.setmode(GPIO.BOARD)
GPIO.setup(16, GPIO.IN)
GPIO.setup(18, GPIO.IN)

def insertar_datos(id, localizacion, status):
    try:
        # Establecer la conexión a la base de datos
        conexion = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="root",
            database="monitoreo"  # Reemplaza con el nombre de tu base de datos
        )

        # Crear un cursor para ejecutar consultas
        cursor = conexion.cursor()

        # Obtener la fecha y hora actual
        fecha_actual = datetime.now()

        # Formatear la fecha y la hora para insertar en la base de datos
        fecha_formateada = fecha_actual.strftime('%Y-%m-%d')
        hora_formateada = fecha_actual.strftime('%H:%M:%S')

        # Consulta de inserción
        consulta_insercion = """INSERT INTO movimiento (id, localizacion, fecha, hora, status) VALUES (%s, %s, %s, %s, %s)"""
        datos = (id, localizacion, fecha_formateada, hora_formateada, status)

        # Ejecutar la consulta de inserción
        cursor.execute(consulta_insercion, datos)

        # Confirmar los cambios
        conexion.commit()
        print("Datos insertados correctamente.")

    except mysql.connector.Error as error:
        print("Error al insertar datos:", error)

    finally:
        # Cerrar la conexión cuando hayas terminado
        if conexion.is_connected():
            cursor.close()
            conexion.close()

id = 0
while True:
    val = GPIO.input(16)
    val2 = GPIO.input(18)
    if val == 0:
        id += 1
        print("Recamara")
        # Ejemplo de uso de la funcion insertar_datos
        insertar_datos(id, "Recamara", 1)
        time.sleep(2)
    if val2 == 0:
        id += 1
        print("Sala de estar")
        insertar_datos(id, "Sala de estar", 1)
        time.sleep(2)
