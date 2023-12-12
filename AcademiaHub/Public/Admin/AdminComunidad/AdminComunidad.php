<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="AdminComunidad.css">
    <title>Administrador de Seminarios - AcademiaHub</title>
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
                    <li class="nav-item"><a class="nav-link" href="../AdminCursos/AdminCursos.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="AdminComunidad.php">Seminarios</a></li>
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
            <h2>Administrador de Seminarios</h2>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#agregarSeminarioModal">Agregar
                Seminario</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Seminario</th>
                        <th>Descripción</th>
                        <th>Orador</th>
                        <th>Fecha</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php
                include('../../../include/dbconn.php');

                $connection = new Conection();
                $conn = $connection->open();

                $seminarios = [];
                try {
                    $sql = 'SELECT * FROM seminarios';
                    $seminarios = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Error en la conexión" . $e->getMessage();
                }
                $connection->close();
                ?>

                <tbody>
                    <?php foreach ($seminarios as $seminario) { ?>
                        <tr>
                            <td>
                                <?php echo $seminario['id_seminario']; ?>
                            </td>
                            <td>
                                <?php echo $seminario['nombre']; ?>
                            </td>
                            <td>
                                <?php echo $seminario['descripcion']; ?>
                            </td>
                            <td>
                                <?php echo $seminario['orador']; ?>
                            </td>
                            <td>
                                <?php echo $seminario['fecha']; ?>
                            </td>
                            <td><img src="./images/<?php echo $seminario['imagen']; ?>" alt="Imagen Seminario"
                                    style="max-width: 100px;"></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editarSeminarioModal<?php echo $seminario['id_seminario']; ?>">Editar</button>

                                <!-- Modal de edición de Seminario -->
                                <div class="modal fade" id="editarSeminarioModal<?php echo $seminario['id_seminario']; ?>"
                                    tabindex="-1" aria-labelledby="editarSeminarioModalLabel<?php echo $seminario['id_seminario']; ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editarSeminarioModalLabel<?php echo $seminario['id_seminario']; ?>">Editar
                                                    Seminario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario de edición de Seminario -->
                                                <form method="POST" action="edit_seminario.php"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="id_seminario"
                                                        value="<?php echo $seminario['id_seminario']; ?>">

                                                    <div class="mb-3">
                                                        <label for="editNombreSeminario" class="form-label">Nombre del
                                                            Seminario</label>
                                                        <input type="text" class="form-control" id="editNombreSeminario"
                                                            name="editNombreSeminario"
                                                            value="<?php echo $seminario['nombre']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editDescripcionSeminario" class="form-label">Descripción
                                                            del Seminario</label>
                                                        <textarea class="form-control" id="editDescripcionSeminario"
                                                            name="editDescripcionSeminario" rows="3"
                                                            required><?php echo $seminario['descripcion']; ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editOradorSeminario" class="form-label">Orador del
                                                            Seminario</label>
                                                        <input type="text" class="form-control" id="editOradorSeminario"
                                                            name="editOradorSeminario"
                                                            value="<?php echo $seminario['orador']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editFechaSeminario" class="form-label">Fecha del
                                                            Seminario</label>
                                                        <input type="date" class="form-control" id="editFechaSeminario"
                                                            name="editFechaSeminario"
                                                            value="<?php echo $seminario['fecha']; ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="imagenSeminarioActual" class="form-label">Imagen
                                                            Actual</label>
                                                        <input type="text" class="form-control" id="imagenSeminarioActual"
                                                            name="imagenSeminarioActual"
                                                            value="<?php echo $seminario['imagen']; ?>" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editImagenSeminario" class="form-label">Seleccionar
                                                            Nueva Imagen</label>
                                                        <input type="file" class="form-control" id="editImagenSeminario"
                                                            name="editImagenSeminario" accept="image/*">
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        name="editarSeminario">Guardar Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarSeminarioModal<?php echo $seminario['id_seminario']; ?>">Eliminar</button>

                                <!-- Modal Eliminar Seminario -->
                                <div class="modal fade" id="eliminarSeminarioModal<?php echo $seminario['id_seminario']; ?>"
                                    tabindex="-1"
                                    aria-labelledby="eliminarSeminarioModalLabel<?php echo $seminario['id_seminario']; ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="eliminarSeminarioModalLabel<?php echo $seminario['id_seminario']; ?>">Eliminar
                                                    Seminario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de que deseas eliminar el seminario "
                                                    <?php echo $seminario['nombre']; ?>"?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <a href="delete_seminario.php?id=<?php echo $seminario['id_seminario']; ?>"
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

    <!-- Modal Agregar Seminario -->
    <div class="modal fade" id="agregarSeminarioModal" tabindex="-1" aria-labelledby="agregarSeminarioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarSeminarioModalLabel">Agregar Nuevo Seminario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add_seminario.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombreSeminario" class="form-label">Nombre del Seminario</label>
                            <input type="text" class="form-control" id="nombreSeminario" name="nombreSeminario"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionSeminario" class="form-label">Descripción del Seminario</label>
                            <textarea class="form-control" id="descripcionSeminario" name="descripcionSeminario"
                                rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="oradorSeminario" class="form-label">Orador del Seminario</label>
                            <input type="text" class="form-control" id="oradorSeminario" name="oradorSeminario"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaSeminario" class="form-label">Fecha del Seminario</label>
                            <input type="date" class="form-control" id="fechaSeminario" name="fechaSeminario" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagenSeminario" class="form-label">Seleccionar Imagen</label>
                            <input type="file" class="form-control" id="imagenSeminario" name="imagenSeminario"
                                accept="image/*" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Seminario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>