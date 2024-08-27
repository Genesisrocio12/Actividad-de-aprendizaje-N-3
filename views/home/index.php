<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Definimos la codificación de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Hacemos que la página sea responsiva en diferentes dispositivos -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página que se muestra en la pestaña del navegador -->
    <title>Gestión de Libros y Autores</title>
    <!-- Enlace al CSS de Bootstrap para estilos predefinidos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la fuente Lora desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Estilo general para el cuerpo de la página */
        body {
            background-color: #e7c98d; /* Color de fondo beige claro */
            color: #543c30; /* Gris oscuro con tono morado para el texto */
        }
        /* Estilos para la barra de navegación */
        .navbar {
            background-color: #7f2f2f; /* Color rojo vintage oscuro */
        }
        .navbar-brand, .nav-link {
            color: #e7c98d !important; /* Beige claro para el texto en la barra de navegación */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #51400f !important; /* Color oscuro en hover para la navegación */
        }
        /* Estilos para el contenedor principal de la página */
        .container {
            background-color: #ffffff; /* Blanco para el fondo del contenedor */
            padding: 20px;
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        }
        /* Estilos para los encabezados */
        h1, h2, h3 {
            color: #36291c; /* Marrón oscuro para los encabezados */
            font-family: 'Lora', serif; /* Aplicar la fuente Lora */
            transition: color 0.3s ease; /* Suavizar el cambio de color */
        }
        h1:hover, h2:hover, h3:hover {
            color: #7f2f2f; /* Rojo vintage oscuro en hover para encabezados */
        }
        /* Estilos para listas no ordenadas */
        ul {
            list-style-type: none; /* Sin puntos en las listas */
            padding-left: 0;
        }
        li {
            margin-bottom: 10px; /* Espacio entre los elementos de la lista */
        }
        /* Estilo para las líneas horizontales */
        hr {
            border: 1px solid #7f2f2f; /* Rojo vintage oscuro para la línea horizontal */
        }
    </style>
</head>
<body>
    <!-- Barra de navegación de la aplicación -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Enlace al inicio de la aplicación -->
            <a class="navbar-brand" href="/proyecto_final">Gestión de Libros y Autores</a>
            <!-- Enlaces de navegación para 'Libros' y 'Autores' -->
            <div class="navbar-nav">
                <a class="nav-link" href="/proyecto_final/libros">Libros</a>
                <a class="nav-link" href="/proyecto_final/autores">Autores</a>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal de la página -->
    <div class="container mt-4">
        <!-- Encabezados para la sección principal -->
        <h1>Aplicación de Tecnologías Web</h1>
        <h2>NRC 17707</h2>
        <h3>Integrantes:</h3>
        <ul>
            <!-- Lista de integrantes del proyecto -->
            <li>Adriana Borja</li>
            <li>Alan Quilumbaquin</li>
            <li>Genesis del Rocio Tito</li>
            <li>Camila Quirola</li>
        </ul>
        <hr>
        <!-- Título y descripción dinámicos pasados desde el controlador -->
        <h2><?php echo $titulo; ?></h2>
        <p><?php echo $descripcion; ?></p>
    </div>

    <!-- Enlace al archivo JavaScript de Bootstrap para funcionalidades interactivas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
