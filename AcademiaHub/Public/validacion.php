<?php
session_start();
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nombreUsuario = $_POST['username'];
        $contrasena = $_POST['password'];

        $connection = new Conection();
        $conn = $connection->open();

        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :nombreUsuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nombre_usuario'];
            header("Location:./CuentaUser/CuentaUser.php");
            exit();
        } else {

            echo '<script>';
            echo 'alert("El correo o la contraseña ingresados son incorrectos. Por favor, inténtelo de nuevo.");';
            echo 'window.location.href = "login/login.php";';
            echo '</script>';
        }

        $connection->close();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
