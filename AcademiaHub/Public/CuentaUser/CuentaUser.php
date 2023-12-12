<?php
session_start();

include('../../include/dbconn.php');


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    $user_id = $_SESSION['user_id'];

    $connection = new Conection();
    $conn = $connection->open();

    $sql = "SELECT * FROM usuarios WHERE id_usuario = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        
        $user = [
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'correo_electronico' => 'correo@example.com',
            'nombre_usuario' => 'Usuario'
        ];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="CuentaUser.css">
    <title>Cuenta - AcademiaHub</title>
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
                    <li class="nav-item sign-in-li">
                        <button class="btn btn-outline-success sign-in-btn" type="button" onclick="window.location.href='CuentaUser.php'"><?php echo $user['nombre_usuario']; ?></button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="container-lg">
            <div class="user-info">
                <h2>Hola, <?php echo $user['nombre_usuario']; ?></h2>
            </div>
            <ul class="user-data">
                <li><strong>Nombre:</strong> <?php echo $user['nombre']; ?></li>
                <li><strong>Apellido Paterno:</strong> <?php echo $user['apellido_paterno']; ?></li>
                <li><strong>Apellido Materno:</strong> <?php echo $user['apellido_materno']; ?></li>
                <li><strong>Correo Electrónico:</strong> <?php echo $user['correo_electronico']; ?></li>
                <li><strong>Usuario:</strong> <?php echo $user['nombre_usuario']; ?></li>
            </ul>
            <a href="../login/cerrar_sesion.php" class="logout-btn" type="button">Cerrar Sesión</a>
            
        </div>
    </main>

    <footer class="footer">
        <section class="container-footer">
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
