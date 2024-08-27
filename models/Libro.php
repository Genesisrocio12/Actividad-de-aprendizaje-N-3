<?php
// Definimos la clase Libro que extiende de DB para gestionar los libros en la base de datos
class Libro extends DB {
    // Propiedades de la clase Libro
    public $id;            // Identificador único del libro
    public $titulo;        // Título del libro
    public $autor_id;      // ID del autor del libro (clave foránea)

    // Método estático para obtener todos los libros junto con el nombre del autor
    public static function all() {
        $db = new DB(); // Creamos una instancia de la clase DB para conectar con la base de datos
        // Ejecutamos una consulta que une las tablas libros y autores para obtener todos los libros
        $query = $db->query("SELECT libros.*, autores.nombre as autor_nombre FROM libros JOIN autores ON libros.autor_id = autores.id");
        // Fetch de los resultados y los mapeamos a la clase Libro
        return $query->fetchAll(PDO::FETCH_CLASS, Libro::class);
    }

    // Método estático para encontrar un libro por su ID
    public static function find($id) {
        $db = new DB(); // Creamos una instancia de la clase DB
        // Preparamos y ejecutamos una consulta para encontrar un libro por su ID
        $query = $db->prepare("SELECT * FROM libros WHERE id = :id");
        $query->execute([':id' => $id]);
        // Fetch del resultado y lo mapeamos a un objeto de la clase Libro
        return $query->fetchObject(Libro::class);
    }

    // Método para guardar un libro (crear o actualizar)
    public function save() {
        // Definimos los parámetros de la consulta
        $params = [
            ":titulo" => $this->titulo,
            ":autor" => $this->autor,
            ":anio_publicacion" => $this->anio_publicacion,
            ":genero" => $this->genero,
            ":isbn" => $this->isbn
        ];

        try {
            // Si el libro no tiene ID (es decir, es nuevo), realizamos una inserción
            if (empty($this->id)) {
                $prepare = $this->prepare("INSERT INTO libros(titulo, autor, anio_publicacion, genero, isbn) VALUES (:titulo, :autor, :anio_publicacion, :genero, :isbn)");
                $prepare->execute($params);
                // Recuperamos el ID del nuevo libro insertado
                $this->id = $this->lastInsertId();
            } else {
                // Si el libro tiene ID (es decir, ya existe), realizamos una actualización
                $params[":id"] = $this->id;
                $prepare = $this->prepare("UPDATE libros SET titulo=:titulo, autor=:autor, anio_publicacion=:anio_publicacion, genero=:genero, isbn=:isbn WHERE id=:id");
                $prepare->execute($params);
            }
        } catch (PDOException $e) {
            // Capturamos cualquier excepción y mostramos el mensaje de error
            echo "Error: " . $e->getMessage();
        }
    }

    // Método para eliminar un libro por su ID
    public function remove() {
        // Preparamos y ejecutamos una consulta para eliminar el libro
        $query = $this->prepare("DELETE FROM libros WHERE id = :id");
        $query->execute([':id' => $this->id]);
    }
}
