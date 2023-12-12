<?php
session_start();
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nombre = $_POST['nombre'];
        $apellidoPaterno = $_POST['apellido-paterno'];
        $apellidoMaterno = $_POST['apellido-materno'];
        $correoElectronico = $_POST['email'];
        $nombreUsuario = $_POST['username'];
        $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

        $connection = new Conection();
        $conn = $connection->open();

        $sql = "INSERT INTO administradores (nombre, apellido_paterno, apellido_materno, correo_electronico, nombre_usuario, contrasena)
                VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :correoElectronico, :nombreUsuario, :contrasena)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidoPaterno', $apellidoPaterno);
        $stmt->bindParam(':apellidoMaterno', $apellidoMaterno);
        $stmt->bindParam(':correoElectronico', $correoElectronico);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario);
        $stmt->bindParam(':contrasena', $contrasena);
        
        $stmt->execute();

        $connection->close();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo '<script>';
    echo 'alert("Registro exitoso!");';
    echo 'window.location.href = "./Admin/loginAdmin/loginAdmin.php";';
    echo '</script>';
    exit();
}
?>
