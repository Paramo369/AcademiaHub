<?php
// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $seminario_id = $_GET['id'];

    // Incluir el archivo de conexión a la base de datos
    include('../../../include/dbconn.php');

    $connection = new Conection();
    $conn = $connection->open();

    try {

        $sqlGetSeminario = 'SELECT * FROM seminarios WHERE id_seminario = :seminario_id';
        $stmtGetSeminario = $conn->prepare($sqlGetSeminario);
        $stmtGetSeminario->bindParam(':seminario_id', $seminario_id, PDO::PARAM_INT);
        $stmtGetSeminario->execute();
        $seminario = $stmtGetSeminario->fetch(PDO::FETCH_ASSOC);

        $rutaImagen = './images/' . $seminario['imagen'];
        unlink($rutaImagen);

        $sqlDeleteSeminario = 'DELETE FROM seminarios WHERE id_seminario = :seminario_id';
        $stmtDeleteSeminario = $conn->prepare($sqlDeleteSeminario);
        $stmtDeleteSeminario->bindParam(':seminario_id', $seminario_id, PDO::PARAM_INT);
        $stmtDeleteSeminario->execute();

        header('Location: AdminComunidad.php');
        exit();
    } catch (PDOException $e) {

        echo "Error al eliminar el seminario: " . $e->getMessage();
    } finally {

        $connection->close();
    }
} else {

    header('Location: AdminComunidad.php');
    exit();
}
?>
