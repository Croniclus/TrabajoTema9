<?php
$servername="localhost:3306";
$username="root";
$password="";
$dbname="trabajobbdd9";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los registros de la tabla 'albums'
    $sql = "SELECT * FROM albums";
    $result = $conn->query($sql);

    $id_usuario = $_GET['id'];
    $stmtDelete = $conn->prepare("DELETE FROM albums WHERE id=:id");
    $stmtDelete->bindParam(':id', $id_usuario);
    $stmtDelete->execute();
    header("Location: tabla.php");

} catch (PDOException $e) {
    echo "Error al intentar obtener datos: " . $e->getMessage();
}
?>