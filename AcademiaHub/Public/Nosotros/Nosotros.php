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
    <link rel="stylesheet" href="Nosotros.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Nosotros.css">
    <title>Nosotros - Academia Hub</title>
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
                    <li class="nav-item"><a class="nav-link" href="Nosotros.php">Nosotros</a></li>
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
  
        <section class="about-us-cover-container">
            <div class="overlay"></div>
            <div class="about-us-cover-content">
                <h1>Descubre más sobre nosotros</h1>
                <p>Conoce nuestra información y el equipo que impulsa Academia Hub. ¡Únete a nuestra comunidad educativa!</p>
            </div>
        </section>
    
        <section class="information-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Nuestra Misión</h2>
                                <p class="card-text">Facilitar el acceso a la educación de calidad, proporcionando recursos y experiencias de aprendizaje innovadoras que inspiren el crecimiento personal y profesional.</p>
                                <ul>
                                    <li>Comprometidos con la excelencia académica y la diversidad de conocimientos.</li>
                                    <li>Fomentar un ambiente inclusivo que motive el aprendizaje colaborativo.</li>
                                    <li>Promover la aplicación práctica de los conocimientos adquiridos.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Nuestra Visión</h2>
                                <p class="card-text">Convertirnos en la principal plataforma educativa global, creando un espacio donde la diversidad de conocimientos y experiencias se fusionen para empoderar a las personas y transformar positivamente la sociedad.</p>
                                <ul>
                                    <li>Ofrecer una variedad de cursos y recursos para satisfacer las necesidades educativas globales.</li>
                                    <li>Construir una comunidad activa y colaborativa de estudiantes y educadores.</li>
                                    <li>Liderar la revolución educativa mediante la integración de tecnologías emergentes.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="creation-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="../images/comunidad2.jpg" alt="Imagen de la Creación" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="creation-story">
                            <h2>Academia Hub</h2>
                            <p>
                                En una ciudad apasionada por la educación y la tecnología, un grupo de visionarios se unió para crear Academia Hub. Este equipo diverso compartía la visión de democratizar la educación global.
                            </p>
                            <p>
                                A través de desafíos y perseverancia, construyeron una plataforma que ofrece cursos en línea, herramientas interactivas y una comunidad activa. Academia Hub se convirtió en un faro global de aprendizaje, inspirando a millones de personas a alcanzar sus metas educativas y dejando un impacto positivo en la vida de muchos.
                            </p>
                            <p>
                                
A medida que Academia Hub se expandía, su enfoque evolucionaba constantemente. La plataforma adoptó nuevas tecnologías y métodos pedagógicos, siempre con el objetivo de mantenerse a la vanguardia de la educación en línea. La diversidad de cursos se amplió, abarcando desde ciencias y humanidades hasta tecnología emergente. Lo que comenzó como un sueño compartido entre un grupo de pioneros se convirtió en una comunidad global activa y vibrante. La historia de Academia Hub es una narrativa de adaptación, crecimiento y el impacto duradero de la educación accesible para todos.
                            </p>
                        </div>
                    </div>
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