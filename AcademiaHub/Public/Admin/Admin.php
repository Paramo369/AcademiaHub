<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="Admin.css">
    <title>Administrador - AcademiaHub</title>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../Admin.php"><img src="../images/Logo.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler bg-success-subtle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Admin.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="./AdminCursos/AdminCursos.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="./AdminComunidad/AdminComunidad.php">Seminarios</a></li>
                    <li class="nav-item sign-in-li">
                        <button class="btn btn-outline-success sign-in-btn" type="button" onclick="window.location.href='./loginAdmin/loginAdmin.php'">Cerrar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="container-lg mt-4">
            <h2>AcademiaHub</h2>
            <h3>Administrador</h3>
        </div>
    </main>

    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
