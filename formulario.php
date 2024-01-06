<?php
$servername="localhost:3306";
$username="root";
$password="";
$dbname="trabajobbdd9";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['login'])){
        $usuario = $_POST['nombreUsuLogin'];
        $contrasena = $_POST['passwdLogin'];
        session_start();

        $query = "SELECT * FROM usuario WHERE nombre = :usuario AND passwd = :contrasena";
        $statement = $conn->prepare($query);
        $statement->bindParam(':usuario', $usuario);
        $statement->bindParam(':contrasena', $contrasena);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // El usuario existe, puedes redirigir o realizar otras acciones
            echo "¡Login exitoso!";
            header("Location: tabla.php");
        } else {
            // El usuario no existe o las credenciales son incorrectas
            echo "Usuario o contraseña incorrectos";
        }
    }
    if (isset($_POST['register'])){
        $nombre = $_POST['nombreUsuRegistro'];
        $apellido = $_POST['apellidoUsuRegistro'];
        $edad = $_POST['edadRegistro'];
        $passwd = $_POST['passwdRegistro'];


        $query = "INSERT INTO usuario (nombre, apellido, edad, passwd) VALUES (:nombre, :apellido, :edad, :passwd)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apellido', $apellido);
        $statement->bindParam(':edad', $edad);
        $statement->bindParam(':passwd', $passwd);

        try {
            $statement->execute();
            // Registro exitoso
            echo "<script>alert('Registro exitoso');</script>";
            header("Location: index.html");
        } catch (PDOException $e) {
            // Error en el registro
            echo "Error al registrar el usuario: " . $e->getMessage();
        }
    }

} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}

?>