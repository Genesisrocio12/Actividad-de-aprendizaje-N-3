<?php
// Verificamos si la función 'view' ya existe para evitar redefinirla
if (!function_exists('view')) {
    // Definimos la función 'view' que se encarga de incluir una vista específica
    function view($nombreVista, $params = []) {
        // Extraemos los parámetros pasados a la vista como variables
        extract($params);
        
        // Dividimos el nombre de la vista en partes utilizando el punto como separador
        $vista = explode('.', $nombreVista);
        
        // Incluimos el archivo PHP correspondiente a la vista desde el directorio 'views'
        include_once "./views/{$vista[0]}/{$vista[1]}.php";
    }
}
