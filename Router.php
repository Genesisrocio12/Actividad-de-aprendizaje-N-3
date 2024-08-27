<?php
class Router {
    // Método principal para gestionar las rutas de la aplicación
    public function route($url) {
        // Dividimos la URL en partes usando '/' como separador
        $urlParts = explode('/', $url);
        
        // Determinamos el nombre del controlador basado en la primera parte de la URL
        // Si no hay controlador en la URL, usamos 'home' por defecto
        $controller = !empty($urlParts[0]) ? $urlParts[0] : 'home';
        
        // Determinamos la acción a ejecutar basado en la segunda parte de la URL
        // Si no hay acción en la URL, usamos 'index' por defecto
        $action = isset($urlParts[1]) ? $urlParts[1] : 'index';
        
        // Determinamos el ID basado en la tercera parte de la URL (si existe)
        $id = isset($urlParts[2]) ? $urlParts[2] : null;

        // Construimos el nombre del archivo del controlador usando el nombre del controlador con 'Controller' al final
        $controllerName = ucfirst($controller) . 'Controller';
        
        // Construimos la ruta del archivo del controlador
        $controllerFile = "controllers/{$controllerName}.php";

        // Verificamos si el archivo del controlador existe
        if (file_exists($controllerFile)) {
            // Incluimos el archivo del controlador
            require_once $controllerFile;
            // Creamos una instancia del controlador
            $controller = new $controllerName();
            // Verificamos si el método de acción existe en el controlador
            if (method_exists($controller, $action)) {
                // Llamamos al método de acción pasando el ID (si existe)
                $controller->$action($id);
            } else {
                // Si el método no existe, mostramos un error 404
                $this->error404();
            }
        } else {
            // Si el archivo del controlador no existe, mostramos un error 404
            $this->error404();
        }
    }

    // Método privado para manejar errores 404 (página no encontrada)
    private function error404() {
        // Enviamos una cabecera HTTP 404
        header("HTTP/1.0 404 Not Found");
        // Mostramos un mensaje de error 404
        echo "404 - Página no encontrada";
    }
}
