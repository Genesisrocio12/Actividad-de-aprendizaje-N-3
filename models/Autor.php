<?php
// Definimos la clase Autor que extiende de DB, manejando la lógica de interacción con la tabla 'autores' en la base de datos
class Autor extends DB {
    // Propiedades de la clase
    public $id;        // ID del autor
    public $nombre;    // Nombre del autor

    // Método estático para obtener todos los autores
    public static function all() {
        // Creamos una nueva instancia de la clase DB para manejar la conexión a la base de datos
        $db = new DB();
        // Ejecutamos una consulta SQL para seleccionar todos los registros de la tabla 'autores'
        $query = $db->query("SELECT * FROM autores");
        // Devolvemos todos los resultados como una lista de objetos de la clase Autor
        return $query->fetchAll(PDO::FETCH_CLASS, Autor::class);
    }

    // Método estático para encontrar un autor por su ID
    public static function find($id) {
        // Creamos una nueva instancia de la clase DB
        $db = new DB();
        // Preparamos una consulta SQL para seleccionar un autor por su ID
        $query = $db->prepare("SELECT * FROM autores WHERE id = :id");
        // Ejecutamos la consulta con el ID proporcionado
        $query->execute([':id' => $id]);
        // Devolvemos el autor encontrado como un objeto de la clase Autor
        return $query->fetchObject(Autor::class);
    }

    // Método para guardar un autor (crear o actualizar)
    public function save() {
        // Creamos una nueva instancia de la clase DB
        $db = new DB();
        // Si el ID está vacío, significa que estamos creando un nuevo autor
        if (empty($this->id)) {
            // Preparamos una consulta SQL para insertar un nuevo autor en la base de datos
            $query = $db->prepare("INSERT INTO autores (nombre) VALUES (:nombre)");
            // Ejecutamos la consulta con el nombre del autor
            $result = $query->execute([':nombre' => $this->nombre]);
            // Si la inserción fue exitosa, obtenemos el ID del nuevo autor
            if ($result) {
                $this->id = $db->lastInsertId();
            }
            // Devolvemos el resultado de la operación de inserción
            return $result;
        } else {
            // Si el ID no está vacío, estamos actualizando un autor existente
            // Preparamos una consulta SQL para actualizar el autor en la base de datos
            $query = $db->prepare("UPDATE autores SET nombre = :nombre WHERE id = :id");
            // Ejecutamos la consulta con el ID y el nombre del autor
            return $query->execute([':id' => $this->id, ':nombre' => $this->nombre]);
        }
    }

    // Método para eliminar un autor
    public function remove() {
        // Creamos una nueva instancia de la clase DB
        $db = new DB();
        // Preparamos una consulta SQL para eliminar un autor por su ID
        $query = $db->prepare("DELETE FROM autores WHERE id = :id");
        // Ejecutamos la consulta con el ID del autor
        return $query->execute([':id' => $this->id]);
    }
}
