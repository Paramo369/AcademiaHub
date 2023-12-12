<?php
session_start();
include('../../../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $nombreCurso = $_POST['nombreCurso'];
        $descripcionCurso = $_POST['descripcionCurso'];
        $creadorCurso = $_POST['creadorCurso'];

        $imagenCurso = $_FILES['imagenCurso']['name'];
        $imagenCursoTemp = $_FILES['imagenCurso']['tmp_name'];

        $carpetaDestino = './images/';
        
        $rutaImagen = $carpetaDestino . $imagenCurso;

        move_uploaded_file($imagenCursoTemp, $rutaImagen);

        $rutaImagen = ltrim(str_replace('./images', '', $rutaImagen), '/');

        $connection = new Conection();
        $conn = $connection->open();

        $sql = "INSERT INTO cursos (nombre, descripcion, creador_del_curso, imagen) VALUES (:nombre, :descripcion, :creador, :imagen)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombreCurso);
        $stmt->bindParam(':descripcion', $descripcionCurso);
        $stmt->bindParam(':creador', $creadorCurso);
        $stmt->bindParam(':imagen', $rutaImagen);
        $stmt->execute();

        $connection->close();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    header("Location: AdminCursos.php");
    exit();
}
?>
