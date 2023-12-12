<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Registro - AcademiaHub</title>
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
                        <button class="btn btn-success sign-in-btn" type="button" onclick="window.location.href='../login/login.php'">Iniciar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Registro</h2>
                            <form action="../registro_users.php" method="POST">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellido-paterno">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="apellido-paterno" name="apellido-paterno" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellido-materno">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="apellido-materno" name="apellido-materno" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Usuario:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <label for="password">Contraseña:</label>
                                <div class="form-group group-password">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="btn-container">
                                    <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                                </div>
                            </form>
                            <p class="text-center mt-3 registrer">¿Ya tienes una cuenta? <a href="../login/login.php">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>

    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/44007c922b.js" crossorigin="anonymous"></script>

</body>

</html>
