<?php
// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $curso_id = $_GET['id'];

    // Incluir el archivo de conexión a la base de datos
    include('../../../include/dbconn.php');

    $connection = new Conection();
    $conn = $connection->open();

    try {
        // Preparar y ejecutar la consulta para eliminar el curso
        $sql = 'DELETE FROM cursos WHERE id_curso = :curso_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir de nuevo a la página de administrador después de eliminar
        header('Location: AdminCursos.php');
        exit();
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "Error al eliminar el curso: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $connection->close();
    }
} else {
    // Redirigir si no se proporcionó un ID válido
    header('Location: AdminCursos.php');
    exit();
}
?>
