<?php
session_start();
include('../../../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $nombreSeminario = $_POST['nombreSeminario'];
        $descripcionSeminario = $_POST['descripcionSeminario'];
        $oradorSeminario = $_POST['oradorSeminario'];
        $fechaSeminario = $_POST['fechaSeminario'];

        $imagenSeminario = $_FILES['imagenSeminario']['name'];
        $imagenSeminarioTemp = $_FILES['imagenSeminario']['tmp_name'];

        $carpetaDestino = './images/';

        $rutaImagen = $carpetaDestino . $imagenSeminario;

        move_uploaded_file($imagenSeminarioTemp, $rutaImagen);

        $rutaImagen = ltrim(str_replace('./images', '', $rutaImagen), '/');

        $connection = new Conection();
        $conn = $connection->open();

        $sql = "INSERT INTO seminarios (nombre, descripcion, orador, fecha, imagen) VALUES (:nombre, :descripcion, :orador, :fecha, :imagen)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombreSeminario);
        $stmt->bindParam(':descripcion', $descripcionSeminario);   
        $stmt->bindParam(':orador', $oradorSeminario);
        $stmt->bindParam(':fecha', $fechaSeminario);                                                     
        $stmt->bindParam(':imagen', $rutaImagen);
        $stmt->execute();

        $connection->close();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    header("Location: AdminComunidad.php");
    exit();
}
?>
