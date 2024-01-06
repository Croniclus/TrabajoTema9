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

    $id = $_GET['id'];
    $campo= $_GET['param2'];
    $info = $_GET['param3'];

    $stmtUpdate = $conn->prepare("UPDATE albums SET $campo = :campo WHERE id = :id");
    $stmtUpdate->bindParam(':campo', $info);
    $stmtUpdate->bindParam(':id', $id);
    $stmtUpdate->execute();
    header("Location: tabla.php");

} catch (PDOException $e) {
    echo "<script>alert('Debe introducir bien los parametros'); window.location.href='tabla.php';</script>";
}
?>