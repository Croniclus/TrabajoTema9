<?php
$servername="localhost:3306";
$username="root";
$password="";
$dbname="trabajobbdd9";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['añadir_Album'])){
        $nombre = $_POST['nombreAlbum'];
        $grupo= $_POST['grupoAlbum'];
        $ano= $_POST['añoAlbum'];


        $query = "INSERT INTO albums (nombre, grupo, ano) VALUES (:nombre, :grupo, :ano)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':grupo', $grupo);
        $statement->bindParam(':ano', $ano);

        try {
            $statement->execute();
            // Registro exitoso
            echo "<script>alert('Album añadido exitosamente');</script>";
            header("Location: tabla.php");
        } catch (PDOException $e) {
            // Error en el registro
            echo "Error al añadir el album: " . $e->getMessage();
        }
    }

} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}

?>