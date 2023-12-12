<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="AdminCursos.css">
    <title>Administrador de Cursos - AcademiaHub</title>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../Admin.php"><img src="../../images/Logo.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler bg-success-subtle" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../Admin.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="AdminCursos.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../AdminComunidad/AdminComunidad.php">Seminarios</a>
                    </li>
                    <li class="nav-item sign-in-li">
                        <button class="btn btn-outline-success sign-in-btn" type="button"
                            onclick="window.location.href='../loginAdmin/loginAdmin.php'">Cerrar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="container-lg mt-4">
            <h2>Administrador de Cursos</h2>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#agregarCursoModal">Agregar
                Curso</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Curso</th>
                        <th>Descripción</th>
                        <th>Creador del Curso</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php
                include('../../../include/dbconn.php');

                $connection = new Conection();
                $conn = $connection->open();

                $cursos = [];
                try {
                    $sql = 'SELECT * FROM cursos';
                    $cursos = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Error en la conexión" . $e->getMessage();
                }
                $connection->close();
                ?>

                <tbody>
                    <?php foreach ($cursos as $curso) { ?>
                        <tr>
                            <td>
                                <?php echo $curso['id_curso']; ?>
                            </td>
                            <td>
                                <?php echo $curso['nombre']; ?>
                            </td>
                            <td>
                                <?php echo $curso['descripcion']; ?>
                            </td>
                            <td>
                                <?php echo $curso['creador_del_curso']; ?>
                            </td>
                            <td><img src="./images/<?php echo $curso['imagen']; ?>" alt="Imagen Curso"
                                    style="max-width: 100px;"></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editarCursoModal<?php echo $curso['id_curso']; ?>">Editar</button>

                                <!-- Modal de edición de Curso -->
                                <div class="modal fade" id="editarCursoModal<?php echo $curso['id_curso']; ?>" tabindex="-1"
                                    aria-labelledby="editarCursoModalLabel<?php echo $curso['id_curso']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editarCursoModalLabel<?php echo $curso['id_curso']; ?>">Editar Curso</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario de edición de Curso -->
                                                <form method="POST" action="edit_curso.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_curso"
                                                        value="<?php echo $curso['id_curso']; ?>">

                                                    <div class="mb-3">
                                                        <label for="editNombreCurso" class="form-label">Nombre del
                                                            Curso</label>
                                                        <input type="text" class="form-control" id="editNombreCurso"
                                                            name="editNombreCurso" value="<?php echo $curso['nombre']; ?>"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editDescripcionCurso" class="form-label">Descripción del
                                                            Curso</label>
                                                        <textarea class="form-control" id="editDescripcionCurso"
                                                            name="editDescripcionCurso" rows="3"
                                                            required><?php echo $curso['descripcion']; ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editCreadorCurso" class="form-label">Creador del
                                                            Curso</label>
                                                        <input type="text" class="form-control" id="editCreadorCurso"
                                                            name="editCreadorCurso"
                                                            value="<?php echo $curso['creador_del_curso']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="imagenCursoActual" class="form-label">Imagen
                                                            Actual</label>
                                                        <input type="text" class="form-control" id="imagenCursoActual"
                                                            name="imagenCursoActual" value="<?php echo $curso['imagen']; ?>"
                                                            readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editImagenCurso" class="form-label">Seleccionar Nueva
                                                            Imagen</label>
                                                        <input type="file" class="form-control" id="editImagenCurso"
                                                            name="editImagenCurso" accept="image/*">
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" name="editarCurso">Guardar
                                                        Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarCursoModal<?php echo $curso['id_curso']; ?>">Eliminar</button>

                                <!-- Modal de eliminación -->
                                <div class="modal fade" id="eliminarCursoModal<?php echo $curso['id_curso']; ?>" tabindex="-1"
                                    aria-labelledby="eliminarCursoModalLabel<?php echo $curso['id_curso']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="eliminarCursoModalLabel<?php echo $curso['id_curso']; ?>">Confirmar
                                                    Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que quieres eliminar el curso "
                                                    <?php echo $curso['nombre']; ?>"?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <!-- Enlace a delete_curso.php con el ID del curso a eliminar -->
                                                <a href="delete_curso.php?id=<?php echo $curso['id_curso']; ?>"
                                                    class="btn btn-danger">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </main>

    <!-- Modal Agregar Curso -->
    <div class="modal fade" id="agregarCursoModal" tabindex="-1" aria-labelledby="agregarCursoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCursoModalLabel">Agregar Nuevo Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add_curso.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombreCurso" class="form-label">Nombre del Curso</label>
                            <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionCurso" class="form-label">Descripción del Curso</label>
                            <textarea class="form-control" id="descripcionCurso" name="descripcionCurso" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="creadorCurso" class="form-label">Creador del Curso</label>
                            <input type="text" class="form-control" id="creadorCurso" name="creadorCurso" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagenCurso" class="form-label">Seleccionar Imagen</label>
                            <input type="file" class="form-control" id="imagenCurso" name="imagenCurso" accept="image/*"
                                required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>