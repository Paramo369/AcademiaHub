<?php
session_start();
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nombreUsuario = $_POST['username'];
        $contrasena = $_POST['password'];

        $connection = new Conection();
        $conn = $connection->open();

        $sql = "SELECT * FROM administradores WHERE nombre_usuario = :nombreUsuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            header("Location: ./Admin/Admin.php");
            exit();
        } else {
            // Script JavaScript para mostrar un alert y redireccionar a la página de inicio de sesión para administradores
            echo '<script>';
            echo 'alert("El nombre de usuario o la contraseña ingresados son incorrectos. Por favor, inténtelo de nuevo.");';
            echo 'window.location.href = "./Admin/loginAdmin/loginAdmin.php";';
            echo '</script>';
        }

        $connection->close();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
