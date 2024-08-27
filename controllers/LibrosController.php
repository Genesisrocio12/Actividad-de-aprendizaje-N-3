<?php
// Definimos la clase LibrosController que se encarga de manejar la lógica relacionada con los libros
class LibrosController {
    // Método para mostrar la lista de libros
    public function index() {
        // Obtenemos todos los libros de la base de datos
        $libros = Libro::all();
        // Renderizamos la vista 'libros.index' y le pasamos la lista de libros
        view("libros.index", ["libros" => $libros]);
    }

    // Método para crear un nuevo libro
    public function create() {
        // Leemos los datos enviados en la solicitud y los decodificamos desde JSON
        $data = json_decode(file_get_contents('php://input'));
        // Creamos una nueva instancia de Libro
        $libro = new Libro();
        // Asignamos los datos recibidos al objeto libro
        $libro->titulo = $data->titulo;
        $libro->autor = $data->autor;
        $libro->anio_publicacion = $data->anio_publicacion;
        $libro->genero = $data->genero;
        $libro->isbn = $data->isbn;
        // Guardamos el libro en la base de datos
        $libro->save();
        // Devolvemos el objeto libro como respuesta en formato JSON
        echo json_encode($libro);
    }

    // Método para actualizar un libro existente
    public function update() {
        // Leemos los datos enviados en la solicitud y los decodificamos desde JSON
        $data = json_decode(file_get_contents('php://input'));
        // Buscamos el libro por su ID
        $libro = Libro::find($data->id);
        // Actualizamos los datos del libro con la información recibida
        $libro->titulo = $data->titulo;
        $libro->autor = $data->autor;
        $libro->anio_publicacion = $data->anio_publicacion;
        $libro->genero = $data->genero;
        $libro->isbn = $data->isbn;
        // Guardamos los cambios en la base de datos
        $libro->save();
        // Devolvemos el objeto libro actualizado como respuesta en formato JSON
        echo json_encode($libro);
    }

    // Método para eliminar un libro
    public function delete($id) {
        try {
            // Buscamos el libro por su ID
            $libro = Libro::find($id);
            // Eliminamos el libro de la base de datos
            $libro->remove();
            // Devolvemos una respuesta en formato JSON indicando que la operación fue exitosa
            echo json_encode(['status' => true]);
        } catch (\Exception $e) {
            // En caso de error, devolvemos una respuesta en formato JSON con el mensaje de error
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    // Método para encontrar un libro por su ID
    public function find($id) {
        // Buscamos el libro por su ID
        $libro = Libro::find($id);
        // Devolvemos el objeto libro encontrado como respuesta en formato JSON
        echo json_encode($libro);
    }
}
