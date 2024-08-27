<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e7c98d; /* Beige claro */
            color: #543c30; /* Marrón oscuro */
            font-family: 'Playfair Display', serif; /* Fuente elegante */
        }
        .navbar {
            background-color: #7f2f2f; /* Rojo vintage oscuro */
        }
        .navbar-brand, .nav-link {
            color: #e7c98d !important; /* Beige claro */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #51400f !important; /* Marrón oscuro */
        }
        .container {
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #36291c; /* Marrón muy oscuro */
            font-size: 2.5rem; /* Tamaño de fuente grande para el título */
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #51400f; /* Marrón oscuro */
            border: none;
        }
        .btn-primary:hover {
            background-color: #36291c; /* Marrón muy oscuro */
        }
        .btn-warning, .btn-danger {
            background-color: #543c30; /* Marrón oscuro */
            border: none;
            color: #ffffff; /* Texto blanco */
        }
        .btn-warning:hover, .btn-danger:hover {
            background-color: #7f2f2f; /* Rojo vintage oscuro */
        }
        table {
            color: #36291c; /* Marrón muy oscuro para el texto de la tabla */
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        thead {
            background-color: #51400f; /* Marrón oscuro */
            color: #e7c98d; /* Beige claro */
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Gris claro alternando filas */
        }
        tbody tr:hover {
            background-color: #e7c98d; /* Beige claro en hover */
        }
        .modal-content {
            background-color: #ffffff; /* Fondo blanco para el modal */
            border: 1px solid #543c30; /* Marrón oscuro para el borde */
        }
        .modal-header {
            background-color: #51400f; /* Marrón oscuro */
            color: #e7c98d; /* Beige claro */
        }
        .modal-footer .btn-secondary {
            background-color: #7f2f2f; /* Rojo vintage oscuro */
            border: none;
        }
        .modal-footer .btn-primary {
            background-color: #51400f; /* Marrón oscuro */
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
        <h1>Gestión de Autores</h1>
        <button class="btn btn-primary mb-3" id="btnAgregarAutor">Agregar Autor</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaAutores">
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?php echo $autor->id; ?></td>
                        <td><?php echo $autor->nombre; ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning btnEditarAutor" data-id="<?php echo $autor->id; ?>">Editar</button>
                            <button class="btn btn-sm btn-danger btnEliminarAutor" data-id="<?php echo $autor->id; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar autor -->
    <div class="modal fade" id="modalAutor" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAutorTitulo">Agregar Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formAutor">
                        <input type="hidden" id="autorId">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarAutor">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const modalAutor = new bootstrap.Modal(document.getElementById('modalAutor'));
        const formAutor = document.getElementById('formAutor');
        const btnGuardarAutor = document.getElementById('btnGuardarAutor');
        const btnAgregarAutor = document.getElementById('btnAgregarAutor');
        const tablaAutores = document.getElementById('tablaAutores');

        btnAgregarAutor.addEventListener('click', () => {
            document.getElementById('modalAutorTitulo').textContent = 'Agregar Autor';
            formAutor.reset();
            modalAutor.show();
        });

        btnGuardarAutor.addEventListener('click', () => {
            const autor = {
                id: document.getElementById('autorId').value,
                nombre: document.getElementById('nombre').value
            };

            const url = autor.id ? '/proyecto_final/autores/update' : '/proyecto_final/autores/create';

            axios.post(url, autor)
                .then(response => {
                    modalAutor.hide();
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
        });

        tablaAutores.addEventListener('click', (e) => {
            if (e.target.classList.contains('btnEditarAutor')) {
                const id = e.target.dataset.id;
                document.getElementById('modalAutorTitulo').textContent = 'Editar Autor';
                axios.get(`/proyecto_final/autores/find/${id}`)
                    .then(response => {
                        const autor = response.data;
                        document.getElementById('autorId').value = autor.id;
                        document.getElementById('nombre').value = autor.nombre;
                        modalAutor.show();
                    })
                    .catch(error => console.error('Error:', error));
            } else if (e.target.classList.contains('btnEliminarAutor')) {
                const id = e.target.dataset.id;
                if (confirm('¿Está seguro de eliminar este autor?')) {
                    axios.delete(`/proyecto_final/autores/delete/${id}`)
                        .then(response => {
                            if (response.data.status) {
                                e.target.closest('tr').remove();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            }
        });
    </script>
</body>
</html>
