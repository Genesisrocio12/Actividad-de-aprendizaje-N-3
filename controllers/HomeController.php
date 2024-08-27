<?php
// Definimos la clase HomeController que se encarga de manejar la lógica para la página de inicio
class HomeController {
    // Método para mostrar la página de inicio
    public function index() {
        // Definimos un array asociativo con parámetros que queremos pasar a la vista
        $params = [
            'titulo' => 'Gestión de Libros y Autores', // El título que se mostrará en la página de inicio
            'descripcion' => 'Esta aplicación permite gestionar libros y autores utilizando tecnologías web.' // Una breve descripción de la aplicación
        ];
        // Llamamos a la función view para renderizar la vista 'home.index' y le pasamos los parámetros definidos
        view('home.index', $params);
    }
}
