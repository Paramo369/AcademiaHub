<?php
session_start();
include('../../../include/dbconn.php');

if (isset($_POST['editarSeminario'])) {
    $database = new Conection();
    $db = $database->open();

    try {
        $id_seminario = $_POST['id_seminario'];
        $nombreSeminario = $_POST['editNombreSeminario'];
        $descripcionSeminario = $_POST['editDescripcionSeminario'];
        $oradorSeminario = $_POST['editOradorSeminario'];
        $fechaSeminario = $_POST['editFechaSeminario'];

        if ($_FILES['editImagenSeminario']['error'] == 0) {
            $imagenSeminario = $_FILES['editImagenSeminario']['name'];
            $imagenSeminario_temp = $_FILES['editImagenSeminario']['tmp_name'];
            move_uploaded_file($imagenSeminario_temp, "./images/$imagenSeminario");
        } else {
            $imagenSeminario = $_POST['imagenSeminarioActual']; 
        }

        $sql = "UPDATE seminarios SET nombre = '$nombreSeminario', descripcion = '$descripcionSeminario', orador = '$oradorSeminario', fecha = '$fechaSeminario', imagen = '$imagenSeminario' WHERE id_seminario = '$id_seminario'";

        $_SESSION['message'] = ($db->exec($sql)) ? 'Seminario actualizado correctamente' : 'No se actualizó el seminario';

    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }

    $database->close();
} else {
    $_SESSION['message'] = "Ingresa los detalles del seminario";
}

header('location: AdminComunidad.php');
?>
