<?php
session_start();

// Incluye el archivo Conection.php
require_once("./include/dbconn.php");

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
    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="Public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="subscription-styles.css">
    <title>Academia Hub</title>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php"><img src="Public/images/Logo.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler bg-success-subtle" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Public/Cursos/Cursos.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Public/Comunidad/Comunidad.php">Comunidad</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Public/ComoFunciona/ComoFunciona.php">Cómo
                            Funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Public/Nosotros/Nosotros.php">Nosotros</a></li>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        // Si hay una sesión iniciada, verifica el tipo de rol del usuario
                        $userInfo = obtenerInformacionUsuario($_SESSION['user_name']);
                        
                        if ($userInfo['admin']) {
                            // Si es un administrador, muestra un mensaje o lo que desees
                            echo '<li><a href="#" class="btn btn-outline-success sign-in-btn" type="button" style="margin-right: 20px;">Administrador: ' . $_SESSION['user_name'] . '</a></li>';
                        } elseif ($userInfo['user']) {
                            // Si es un usuario normal, cambia el botón a "Mi Cuenta"
                            echo '<li><a href="./Public/CuentaUser/CuentaUser.php" class="btn btn-outline-success sign-in-btn" type="button" style="margin-right: 20px;">' . $_SESSION['user_name'] . '</a></li>';
                        } else {
                            // Si no está en ninguna tabla, permite cambiar el botón
                            echo '<li><a href="Public/login/login.php" class="btn btn-success sign-in-btn" type="button" style="margin-right: 20px;">Iniciar Sesión</a></li>';
                        }
                    } else {
                        // Si no hay sesión iniciada, muestra el botón de inicio de sesión
                        echo '<li><a href="Public/login/login.php" class="btn btn-success sign-in-btn" type="button" style="margin-right: 20px;">Iniciar Sesión</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <section class="subscription-container">
            <div class="overlay"></div>
            <div class="subscription-content">
                <h1>Registrate a AcademiaHub</h1>
                <p>Recibe las últimas actualizaciones de cursos y contenido exclusivo.</p>
            </div>
            <div class="btn-register-container">
                <button class="btn btn-success btn-register"
                    onclick="window.location.href='./Public/Registro/Registro.php'">Regístrate</button>
            </div>
        </section>

        <section class="courses-section container mt-5">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="courses-text text-center">
                        <h2>¡Conoce nuestra variedad de cursos!</h2>
                        <p>Descubre nuestra amplia gama de cursos educativos que abarcan diferentes temas y niveles.
                            Desde programación hasta arte, ¡tenemos algo para todos!.</p>
                        <button class="btn btn-success courses-btn" type="button"
                            onclick="window.location.href='./Public/Cursos/Cursos.php'">Explorar Cursos</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits-section container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="benefit-box text-center">
                        <i class="fas fa-certificate fa-3x mb-3"></i>
                        <h3>Certificación</h3>
                        <p>Obtén certificados reconocidos al completar tus cursos.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-box text-center">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                        <h3>Expertos</h3>
                        <p>Aprende de expertos en la industria con experiencia real.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-box text-center">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3>Comunidad</h3>
                        <p>Únete a una comunidad activa de aprendices y profesionales.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="community">
            <section class="wave-section">
                <div class="wave"></div>
            </section>
            <div class="community-explanation container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Únete a Nuestra Comunidad</h2><br>
                        <ul>
                            <li>Compartir conocimientos y experiencias.</li>
                            <li>Participar en discusiones enriquecedoras sobre diversos temas.</li>
                            <li>Acceder a eventos exclusivos y sesiones de networking.</li>
                            <li>Colaborar con expertos de la industria y otros aprendices.</li>
                        </ul>
                        <p>¡Haz parte de nuestra comunidad activa y potencia tu aprendizaje!</p>
                        <button class="btn btn-success community-btn" type="button"
                            onclick="window.location.href='./Public/Comunidad/Comunidad.php'">Únete Ahora</button>
                    </div>
                    <div class="col-md-6">
                        <img src="Public/images/comunidad.jpg" alt="Imagen de la Comunidad" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>


        <section class="container-fluid">
            <div class="how-it-works-section container mt-5">
                <div class="row">
                    <div class="col-md-5">
                        <img src="Public/images/funcionamiento.jpg" alt="Cómo Funciona" class="img-fluid">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="how-it-works-text">
                            <h2>¿Cómo Funciona?</h2>
                            <p>Descubre cómo AcademiaHub te proporciona una experiencia educativa única con
                                certificaciones reconocidas por instituciones líderes.</p>
                            <ul class="how-it-works-list">
                                <li><i class="fas fa-star"></i> Explora nuestra amplia gama de cursos.</li>
                                <li><i class="fas fa-star"></i> Sumérgete en el contenido educativo de calidad.</li>
                                <li><i class="fas fa-star"></i> Completa los cursos con éxito y obtén certificaciones
                                    reconocidas.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-us-section container mt-5">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-us-text">
                        <h2>Nosotros</h2>
                        <p>Somos AcademiaHub, una plataforma dedicada a proporcionar educación de alta calidad en una
                            variedad de campos. Nuestra misión es facilitar el aprendizaje accesible y colaborativo para
                            todos.</p>
                        <p>Con un equipo de expertos en la industria y una comunidad activa de estudiantes, estamos
                            comprometidos a brindar una experiencia educativa única y enriquecedora.</p>
                        <p>Únete a nosotros en el viaje del conocimiento y descubre un mundo de oportunidades
                            educativas.</p>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <img src="Public/images/nosotros.jpg" alt="Nosotros" class="img-fluid">
                </div>
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
                    <a href="index.php"><img src="./Public/images/LogoNegro.png" alt="Logo" class="logo-en-footer"></a>
                    <p>&copy; 2023 AcademiaHub - Todos los derechos reservados</p>
                </div>
            </div>
        </section>
    </footer>


    <script src="Public/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/44007c922b.js" crossorigin="anonymous"></script>

</body>

</html>