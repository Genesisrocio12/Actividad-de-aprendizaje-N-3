<?php
// Definimos la clase DB que extiende de PDO para gestionar la conexión a la base de datos
class DB extends PDO {
    // Constructor de la clase DB
    public function __construct() {
        // Definimos el Data Source Name (DSN) para conectar con la base de datos
        $dsn = 'mysql:host=localhost;dbname=proyecto_final';
        // Llamamos al constructor de la clase PDO con el DSN, el usuario y la contraseña
        parent::__construct($dsn, 'root', '');
    }
}
