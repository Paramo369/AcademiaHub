<?php
session_start();

// Incluye el archivo Conection.php
require_once("../../include/dbconn.php");

// Función para obtener la información del usuario desde la base de datos
function obtenerInformacionUsuario($nombreUsuario) {
    $conexion = new Conection();
    $conn = $conexion->open();
    
    if (!$conn) {
        die("Error al conectar a la base de datos");
    }

    // Consulta para obtener la información del usuario
    $consultaAdmin = "SELECT * FROM administradores WHERE nombre_usuario = ?";
    $stmtAdmin = $conn->prepare($consultaAdmin);
    $stmtAdmin->execute([$nombreUsuario]);
    $adminInfo = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    $consultaUser = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmtUser = $conn->prepare($consultaUser);
    $stmtUser->execute([$nombreUsuario]);
    $userInfo = $stmtUser->fetch(PDO::FETCH_ASSOC);

    $conexion->close();

    return ['admin' => $adminInfo, 'user' => $userInfo];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Cursos.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Cursos.css">
    <title>Cursos - Academia Hub</title>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../../index.php"><img src="../images/Logo.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler bg-success-subtle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Cursos/Cursos.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Comunidad/Comunidad.php">Comunidad</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ComoFunciona/ComoFunciona.php">Cómo Funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Nosotros/Nosotros.php">Nosotros</a></li>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        // Si hay una sesión iniciada, verifica el tipo de rol del usuario
                        $userInfo = obtenerInformacionUsuario($_SESSION['user_name']);
                        
                        if ($userInfo['admin']) {
                            // Si es un administrador, muestra un mensaje o lo que desees
                            echo '<li><a href="#" class="btn btn-outline-success sign-in-btn" type="button" style="margin-right: 20px;">Administrador: ' . $_SESSION['user_name'] . '</a></li>';
                        } elseif ($userInfo['user']) {
                            // Si es un usuario normal, cambia el botón a "Mi Cuenta"
                            echo '<li><a href="../CuentaUser/CuentaUser.php" class="btn btn-outline-success sign-in-btn" type="button" style="margin-right: 20px;">' . $_SESSION['user_name'] . '</a></li>';
                        } else {
                            // Si no está en ninguna tabla, permite cambiar el botón
                            echo '<li><a href="../login/login.php" class="btn btn-success sign-in-btn" type="button" style="margin-right: 20px;">Iniciar Sesión</a></li>';
                        }
                    } else {
                        // Si no hay sesión iniciada, muestra el botón de inicio de sesión
                        echo '<li><a href="../login/login.php" class="btn btn-success sign-in-btn" type="button" style="margin-right: 20px;">Iniciar Sesión</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <section class="courses-cover-container">
            <div class="overlay"></div>
            <div class="courses-cover-content">
                <h1>Conoce todos nuestros cursos</h1>
                <p>Descubre una amplia variedad de cursos educativos para potenciar tu aprendizaje. ¡Encuentra el curso perfecto para ti!</p>
            </div>
        </section>

        <?php

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

        <section class="courses-section container">
            <input type="text" id="curso-buscador" placeholder="Buscar...">
            <div class="row">
                <?php foreach ($cursos as $curso) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../Admin/AdminCursos/images/<?php echo $curso['imagen']; ?>" alt="Imagen Curso" style="width: 100%; border-radius: 5px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $curso['nombre']; ?></h5>
                                <p class="card-text">Autor: <?php echo $curso['creador_del_curso']; ?></p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $curso['id_curso']; ?>">
                                    Ver Detalles
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Modal para cada curso -->
                    <div class="modal fade" id="exampleModal<?php echo $curso['id_curso']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del Curso</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Nombre del Curso: <?php echo $curso['nombre']; ?></h5>
                                    <p>Descripción: <?php echo $curso['descripcion']; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <p id="mensaje-no-cursos" style="display: none;">No hay cursos disponibles.</p>
                <p id="mensaje-no-resultado" style="display: none;">No se encontraron cursos que coincidan con la búsqueda.</p>

            </div>
        </section>

    </main>

    <footer class="footer">
        <section class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-md-12 text-center">
                    <a href="../../index.php"><img src="../images/logoNegro.png" alt="Logo" class="logo-en-footer"></a>
                    <p>&copy; 2023 AcademiaHub - Todos los derechos reservados</p>
                </div>
            </div>
        </section>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var buscadorInput = document.getElementById("curso-buscador");
            var cursosContainer = document.getElementById("cursos-container");
            var mensajeNoCursos = document.getElementById("mensaje-no-cursos");
            var mensajeNoResultado = document.getElementById("mensaje-no-resultado");

            buscadorInput.addEventListener("input", function() {
                var valorBuscador = buscadorInput.value.toLowerCase();
                var tarjetasCursos = document.querySelectorAll(".courses-section .card");

                var cursosEncontrados = false;

                tarjetasCursos.forEach(function(tarjetaCurso) {
                    var tituloCurso = tarjetaCurso.querySelector(".card-title").innerText.toLowerCase();

                    if (tituloCurso.includes(valorBuscador)) {
                        tarjetaCurso.closest('.col-md-4').style.display = "flex";
                        cursosEncontrados = true;
                    } else {
                        tarjetaCurso.closest('.col-md-4').style.display = "none";
                    }
                });

                if (cursosEncontrados) {
                    mensajeNoCursos.style.display = "none";
                    mensajeNoResultado.style.display = "none";
                } else {
                    if (valorBuscador === "") {
                        tarjetasCursos.forEach(function(tarjetaCurso) {
                            tarjetaCurso.closest('.col-md-4').style.display = "flex";
                        });
                        mensajeNoCursos.style.display = "none";
                        mensajeNoResultado.style.display = "none";
                    } else {
                        mensajeNoCursos.style.display = "none";
                        mensajeNoResultado.style.display = "block";
                    }
                }
            });
        });
    </script>


    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/44007c922b.js" crossorigin="anonymous"></script>

</body>

</html>