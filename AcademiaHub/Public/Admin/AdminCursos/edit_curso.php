<?php
session_start();
include('../../../include/dbconn.php');

if (isset($_POST['editarCurso'])) {
    $database = new Conection();
    $db = $database->open();

    try {
        $id_curso = $_POST['id_curso'];
        $nombreCurso = $_POST['editNombreCurso'];
        $descripcionCurso = $_POST['editDescripcionCurso'];
        $creadorCurso = $_POST['editCreadorCurso'];

        if ($_FILES['editImagenCurso']['error'] == 0) {
            $imagenCurso = $_FILES['editImagenCurso']['name'];
            $imagenCurso_temp = $_FILES['editImagenCurso']['tmp_name'];
            move_uploaded_file($imagenCurso_temp, "./images/$imagenCurso");
        } else {
       
            $imagenCurso = $_POST['imagenCursoActual']; 
        }

        $sql = "UPDATE cursos SET nombre = '$nombreCurso', descripcion = '$descripcionCurso', creador_del_curso = '$creadorCurso', imagen = '$imagenCurso' WHERE id_curso = '$id_curso'";

        $_SESSION['message'] = ($db->exec($sql)) ? 'Curso actualizado correctamente' : 'No se actualizó el curso';

    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }

    $database->close();
} else {
    $_SESSION['message'] = "Ingresa los detalles del curso";
}

header('location: AdminCursos.php');
?>