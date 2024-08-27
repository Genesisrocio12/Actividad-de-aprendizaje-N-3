# Proyecto de Virtualización de Redes

Este repositorio contiene el proyecto de virtualización de redes desarrollado por nuestro grupo como parte del curso. A continuación, se proporciona una descripción del proyecto, las tecnologías utilizadas y las instrucciones para ejecutar la aplicación.

## Descripción del Proyecto

El objetivo de este proyecto es implementar una solución de virtualización de redes que permita simular diferentes escenarios de redes para pruebas y aprendizaje. La virtualización de redes es una tecnología clave en el campo de las redes y telecomunicaciones, ya que permite crear y gestionar múltiples redes virtuales sobre una infraestructura física compartida.

## Tecnologías Utilizadas

- **XAMPP:** Utilizado para crear un entorno de servidor local con Apache, MySQL, y PHP.
- **Visual Studio Code:** Utilizado como editor de código para desarrollar scripts y gestionar archivos de configuración.
- **PHP:** Utilizado para desarrollar la lógica de negocio del proyecto y manejar la interacción con la base de datos.
- **MySQL:** Utilizado como el sistema de gestión de bases de datos relacional para almacenar y gestionar datos de la aplicación.

## Instrucciones para Ejecutar la Aplicación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/tu_usuario/nombre_del_repositorio.git
   cd nombre_del_repositorio
## Instalar XAMPP:
Si no tienes XAMPP instalado, descárgalo e instálalo desde [aquí](https://www.apachefriends.org/index.html).

1. **Configurar la base de datos:**
   * Inicia XAMPP y abre phpMyAdmin.
   * Crea una nueva base de datos y ejecuta el script SQL proporcionado en el directorio `sql/` para configurar las tablas necesarias.

2. **Configurar el entorno de desarrollo:**
   * Abre el proyecto en Visual Studio Code.
   * Asegúrate de que XAMPP esté corriendo y que los servicios de Apache y MySQL estén activados.
   * Configura los archivos de conexión a la base de datos si es necesario.

3. **Ejecutar la aplicación:**
   * Coloca los archivos del proyecto en el directorio `htdocs` de XAMPP.
   * Accede a la aplicación desde el navegador usando `http://localhost/nombre_del_proyecto`.

4. **Verificación:**
   * Navega por la aplicación y realiza pruebas para asegurarte de que todas las funcionalidades están operativas.
   * Puedes verificar la conexión con la base de datos y la correcta ejecución de los scripts PHP.

## Autores:
Este proyecto fue desarrollado por:
* **Adriana Borja**
* **Alan Quilumbaquin**
* **Genesis del Rocio Tito**
* **Camila Quirola**
