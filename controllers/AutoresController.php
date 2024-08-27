<?php
// Definimos la clase AutoresController que manejará las operaciones relacionadas con los autores
class AutoresController {
    // Método para mostrar la lista de autores
    public function index() {
        // Llamamos al modelo Autor para obtener todos los registros de autores
        $autores = Autor::all();
        // Llamamos a la función view para mostrar la vista 'autores.index', pasándole los autores obtenidos
        view('autores.index', ['autores' => $autores]);
    }

    // Método para crear un nuevo autor
    public function create() {
        // Decodificamos el JSON recibido en el cuerpo de la solicitud y lo convertimos en un array asociativo
        $data = json_decode(file_get_contents('php://input'), true);
        // Creamos una nueva instancia del modelo Autor
        $autor = new Autor();
        // Asignamos el nombre del autor a partir de los datos recibidos
        $autor->nombre = $data['nombre'];
        // Guardamos el nuevo autor en la base de datos
        $result = $autor->save();
        
        // Enviamos una respuesta JSON con el estado de la operación
        if ($result) {
            echo json_encode(['status' => true, 'message' => 'Autor creado con éxito', 'autor' => $autor]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Error al crear el autor']);
        }
    }

    // Método para actualizar un autor existente
    public function update() {
        // Decodificamos el JSON recibido en el cuerpo de la solicitud y lo convertimos en un array asociativo
        $data = json_decode(file_get_contents('php://input'), true);
        // Buscamos el autor por ID
        $autor = Autor::find($data['id']);
        if ($autor) {
            // Actualizamos el nombre del autor con los datos recibidos
            $autor->nombre = $data['nombre'];
            // Guardamos los cambios en la base de datos
            $result = $autor->save();
            // Enviamos una respuesta JSON con el estado de la operación
            if ($result) {
                echo json_encode(['status' => true, 'message' => 'Autor actualizado con éxito', 'autor' => $autor]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Error al actualizar el autor']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Autor no encontrado']);
        }
    }

    // Método para eliminar un autor
    public function delete($id) {
        // Buscamos el autor por ID
        $autor = Autor::find($id);
        if ($autor) {
            // Eliminamos el autor de la base de datos
            $result = $autor->remove();
            // Enviamos una respuesta JSON con el estado de la operación
            if ($result) {
                echo json_encode(['status' => true, 'message' => 'Autor eliminado con éxito']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Error al eliminar el autor']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Autor no encontrado']);
        }
    }

    // Método para encontrar un autor por ID
    public function find($id) {
        // Buscamos el autor por ID
        $autor = Autor::find($id);
        // Enviamos una respuesta JSON con los datos del autor si se encuentra, o un mensaje de error si no
        if ($autor) {
            echo json_encode($autor);
        } else {
            echo json_encode(['status' => false, 'message' => 'Autor no encontrado']);
        }
    }
}
