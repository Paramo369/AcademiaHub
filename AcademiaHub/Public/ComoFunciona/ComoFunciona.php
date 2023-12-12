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
    <link rel="stylesheet" href="ComoFunciona.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="ComoFunciona.css">
    <title>Cómo Funciona - Academia Hub</title>
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
                    <li class="nav-item"><a class="nav-link" href="ComoFunciona.php">Cómo Funciona</a></li>
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
                        echo '<li><a href="..login/login.php" class="btn btn-success sign-in-btn" type="button" style="margin-right: 20px;">Iniciar Sesión</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <section class="how-it-works-cover-container">
            <div class="overlay"></div>
            <div class="how-it-works-cover-content">
                <h1>Descubre cómo funciona nuestra página</h1>
                <p>Explora los pasos clave para aprovechar al máximo nuestra plataforma educativa. ¡Empieza tu viaje de aprendizaje ahora!</p>
            </div>
        </section>
        <section class="how-it-works-details-container">
            <div class="how-it-works-details-content">
                <h2>Pasos para Aprovechar Nuestra Plataforma</h2>
                <ul>
                    <li>Explora nuestros cursos: Navega a través de nuestra amplia variedad de cursos educativos.</li>
                    <li>Selecciona un curso: Elige el curso que se adapte a tus necesidades y preferencias.</li>
                    <li>Regístrate: Crea una cuenta gratuita o inicia sesión si ya eres miembro.</li>
                    <li>Aprende a tu propio ritmo: Accede a contenido educativo de alta calidad y aprende a tu propio ritmo.</li>
                    <li>Participa en la comunidad: Únete a nuestra comunidad, comparte experiencias y ayuda a otros estudiantes.</li>
                </ul>
            </div>
        </section>
        <section class="image-gallery-container">
        <div class="image-gallery">
            <figure>
                <img src="../images/funciona1.jpg">
            </figure>
            <figure>
                <img src="../images/funciona2.jpg">
            </figure>
            <figure>
                <img src="../images/funciona3.jpg">
            </figure>
            <figure>
                <img src="../images/funciona4.jpg">
            </figure>
            <figure>
                <img src="../images/funciona5.jpg">
            </figure>
            <figure>
                <img src="../images/funciona6.jpg">
            </figure>
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

    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/44007c922b.js" crossorigin="anonymous"></script>

</body>

</html>