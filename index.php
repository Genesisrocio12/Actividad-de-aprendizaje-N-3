<?php
// Incluimos los archivos necesarios para el funcionamiento de la aplicación

require_once 'utils/functions.php';
// Este archivo contiene funciones auxiliares que utilizaremos en diferentes partes del proyecto.

require_once 'models/DB.php';
// Aquí se incluye la clase DB que maneja la conexión a la base de datos y la ejecución de consultas.

require_once 'models/Libro.php';
// Incluimos la clase Libro, que se encarga de gestionar los libros en nuestra aplicación.

require_once 'models/Autor.php';
// Incluimos la clase Autor, que maneja la gestión de los autores.

require_once 'router.php';
// Incluimos el archivo del router, que se encarga de gestionar las rutas de nuestra aplicación.

$router = new Router();
// Creamos una nueva instancia del Router que se encargará de dirigir las solicitudes a los controladores adecuados.

$router->route($_GET['url'] ?? '');
// Llamamos al método 'route' del router, pasando la URL actual. Si no hay una URL en la solicitud, se usa una cadena vacía por defecto.
// El router analizará la URL y redirigirá la solicitud al controlador correspondiente.
