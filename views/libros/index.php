<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e7c98d; 
            color: #543c30; 
            font-family: 'Playfair Display', serif; 
        }
        .navbar {
            background-color: #7f2f2f; 
        }
        .navbar-brand, .nav-link {
            color: #e7c98d !important; 
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #51400f !important; 
        }
        .container {
            background-color: #ffffff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #36291c; 
            font-size: 2.5rem; 
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #51400f; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #36291c; 
        }
        .btn-warning, .btn-danger {
            background-color: #543c30; 
            border: none;
            color: #ffffff; 
        }
        .btn-warning:hover, .btn-danger:hover {
            background-color: #7f2f2f; 
        }
        table {
            color: #36291c; 
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        thead {
            background-color: #51400f; 
            color: #e7c98d; 
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; 
        }
        tbody tr:hover {
            background-color: #e7c98d; 
        }
        .modal-content {
            background-color: #ffffff; 
            border: 1px solid #543c30; 
        }
        .modal-header {
            background-color: #51400f;
            color: #e7c98d; 
        }
        .modal-footer .btn-secondary {
            background-color: #7f2f2f; 
            border: none;
        }
        .modal-footer .btn-primary {
            background-color: #51400f; 
            border: none;
        }
        .modal-footer .btn-secondary:hover, .modal-footer .btn-primary:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/proyecto_final">Gestión de Libros y Autores</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/proyecto_final/libros">Libros</a>
                <a class="nav-link" href="/proyecto_final/autores">Autores</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Gestión de Libros</h1>
        <button class="btn btn-primary mb-3" id="btnAgregarLibro">Agregar Libro</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaLibros">
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($libro->id); ?></td>
                        <td><?php echo htmlspecialchars($libro->titulo); ?></td>
                        <td><?php echo htmlspecialchars($libro->autor_nombre); ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning btnEditarLibro" data-id="<?php echo htmlspecialchars($libro->id); ?>">Editar</button>
                            <button class="btn btn-sm btn-danger btnEliminarLibro" data-id="<?php echo htmlspecialchars($libro->id); ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar libro -->
    <div class="modal fade" id="modalLibro" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLibroTitulo">Agregar Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formLibro">
                        <input type="hidden" id="libroId">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="autorId" class="form-label">Autor</label>
                            <select class="form-select" id="autorId" required>
                                <?php foreach ($autores as $autor): ?>
                                    <option value="<?php echo htmlspecialchars($autor->id); ?>"><?php echo htmlspecialchars($autor->nombre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarLibro">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const modalLibro = new bootstrap.Modal(document.getElementById('modalLibro'));
        const formLibro = document.getElementById('formLibro');
        const btnGuardarLibro = document.getElementById('btnGuardarLibro');
        const btnAgregarLibro = document.getElementById('btnAgregarLibro');
        const tablaLibros = document.getElementById('tablaLibros');

        btnAgregarLibro.addEventListener('click', () => {
            document.getElementById('modalLibroTitulo').textContent = 'Agregar Libro';
            formLibro.reset();
            document.getElementById('autorId').value = ''; // Restablecer el valor del selector
            modalLibro.show();
        });

        btnGuardarLibro.addEventListener('click', () => {
            const libro = {
                id: document.getElementById('libroId').value,
                titulo: document.getElementById('titulo').value,
                autor_id: document.getElementById('autorId').value
            };

            const url = libro.id ? '/proyecto_final/libros/update' : '/proyecto_final/libros/create';

            axios.post(url, libro)
                .then(response => {
                    modalLibro.hide();
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
        });

        tablaLibros.addEventListener('click', (e) => {
            if (e.target.classList.contains('btnEditarLibro')) {
                const id = e.target.dataset.id;
                document.getElementById('modalLibroTitulo').textContent = 'Editar Libro';
                axios.get(`/proyecto_final/libros/${id}`)
                    .then(response => {
                        const libro = response.data;
                        document.getElementById('libroId').value = libro.id;
                        document.getElementById('titulo').value = libro.titulo;
                        document.getElementById('autorId').value = libro.autor_id;
                        modalLibro.show();
                    })
                    .catch(error => console.error('Error:', error));
            } else if (e.target.classList.contains('btnEliminarLibro')) {
                const id = e.target.dataset.id;
                if (confirm('¿Estás seguro de que quieres eliminar este libro?')) {
                    axios.post('/proyecto_final/libros/delete', { id })
                        .then(response => location.reload())
                        .catch(error => console.error('Error:', error));
                }
            }
        });
    </script>
</body>
</html>
