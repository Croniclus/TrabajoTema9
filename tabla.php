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

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Álbumes</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style_tabla.css">
</head>
<body>

    <h2>Tabla de Álbumes</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Grupo</th>
            <th>Año</th>
            <th>Eliminar</th>
            <th>Editar</th>
        </tr>

        <?php
        // Mostrar datos en la tabla
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['Nombre']}</td>";
            echo "<td>{$row['Grupo']}</td>";
            echo "<td>{$row['Ano']}</td>";
            echo "<td><button onclick=\"eliminarFila({$row['id']})\">Eliminar</button></td>";
            echo "<td><button onclick=\"modificarFila({$row['id']})\">Modificar</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <script>
        // Función para eliminar una fila
        function eliminarFila(id) {
            if (confirm("¿Seguro que quieres eliminar esta fila?")) {
                window.location.href = "eliminar.php?id=" + id;
                /*$id_usuario = $id;
                $stmtDelete = $conn->prepare("DELETE * FROM albums WHERE id=:id");
                $stmtDelete->bindParam(':id', $id_usuario);
                $stmtDelete->execute();
                alert("Para ver los cambios debe reiniciar la pagina");*/
            }
        }

        // Función para modificar una fila (puedes redirigir a una página de edición)
        function modificarFila(id) {
            var campo = prompt("Introduzca el campo que desea cambiar");
            var nueva_informacion = prompt("Introduzca la nueva informacion");
            // Redirigir a una página de edición con el ID como parámetro
            window.location.href = "editar.php?id=" + id + "&param2=" + campo + "&param3=" + nueva_informacion;
        }
    </script>

</body>
</html>

    <form id="register" tabindex="502" action="añadir_Album.php" method="post">
			<h3>Añadir album</h3>
			<div class="name">
                <label>Nombre del album</label>
				<input type="text" name="nombreAlbum">
			</div>
			<div class="apellido">
			    <label>Grupo del album</label>	
                <input type="text" name="grupoAlbum">
			</div>
			<div class="edad">
			    <label>Año de lanzamiento</label>	
                <input type="number" name="añoAlbum">
			</div>
			<div class="submit">
				<button class="dark" name="añadir_Album">Añadir</button>
			</div>
    </form>

<?php
} catch (PDOException $e) {
    echo "Error al intentar obtener datos: " . $e->getMessage();
}
?>