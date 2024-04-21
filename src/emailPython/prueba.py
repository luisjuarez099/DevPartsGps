import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Configuración del servidor SMTP
smtp_server = 'smtp.gmail.com'
smtp_port = 587
smtp_username = 'yasertabares00@gmail.com'
smtp_password = 'glhkhexgljiwxblp'

# Crear el objeto del mensaje
msg = MIMEMultipart()
msg['From'] = 'yasertabares00@gmail.com'
msg['To'] = 'luisjuarezcc9@gmail.com'
msg['Subject'] = 'Movimiento detectado'
def enviar_mensaje(Localizacion, fecha, hora):
        # Cuerpo del mensaje
        message = 'Se a detectado un movimiento en: ' +  Localizacion + " a las: "+ hora + " en la fecha: " + fecha + "."

        # Adjuntar el mensaje al objeto del mensaje
        msg.attach(MIMEText(message, 'plain'))

        # Iniciar la conexión SMTP
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        server.login(smtp_username, smtp_password)

        # Intentar enviar el correo electrónico
        try:
            server.send_message(msg)
            print('Correo electrónico enviado exitosamente.')
        except Exception as e:
            print('Error al enviar el correo electrónico:', e)

        # Cerrar la conexión SMTP
        server.quit()


localizacion = "Puerta Principal"

if localizacion == "Puerta Principal":
     print("hola")