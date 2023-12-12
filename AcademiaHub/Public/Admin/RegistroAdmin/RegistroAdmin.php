<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="RegistroAdmin.css">
    <title>Administrador registro - AcademiaHub</title>
</head>

<body>

    <main class="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Registro</h2>
                            <form action="../../registro_AdminUsers.php" method="POST">
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
                            <p class="text-center mt-3 registrer">¿Ya tienes una cuenta? <a href="../../Admin/loginAdmin/loginAdmin.php">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>

    <script src="../../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/44007c922b.js" crossorigin="anonymous"></script>

</body>

</html>
