<?php
$cantidadGalletas = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="js/script.js"></script>
    <title>Document</title>
</head>

<body>
    <header class="blubla">
        <h1>Galletoria</h1>
        <?php
        $cantidadGalletas = 0;
        $galletoriers = 0;
        $cpc = 1;
        if (!isset($_GET["user"])) {
            echo '<form class="insertarNombre" action="index.php" method="get">
                    <label for="user">Nombre de Usuario:</label>
                    <input type="text" id="user" name="user" required>
                    <input type="submit" value="Enviar" onclick="empezar()">
                </form>';
        } else {
            echo "<div hidden>";
            try {
                $servername = "localhost";//cambiar a mysql
                $username = "root";
                $password = "";
                $database = "galletoria";
            
                $conn = new mysqli($servername, $username, $password, $database);//añadir 3306 al final

                if ($conn->connect_error) {
                    throw new Exception("Conexión fallida: " . $conn->connect_error);
                }

                $nick = isset($_GET["user"]) ? $_GET["user"] : "";
                $sql = "SELECT * FROM usuarios WHERE nick = '$nick'";
                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $cantidadGalletas = $row["cantidadGalletas"];
                        $galletoriers = $row["galletoriers"];
                        $cpc = $row["cpc"];
                    } else {
                        $insertSql = "INSERT INTO usuarios (nick, cantidadGalletas) VALUES ('$nick', 0)";
                        if ($conn->query($insertSql) === TRUE) {
                        } else {
                            throw new Exception("Error al crear el nuevo usuario: " . $conn->error);
                        }
                    }
                } else {
                    throw new Exception("Error en la consulta: " . $conn->error);
                }
            } catch (Exception $e) {
                echo "<p id='error'></p><div>";
            }
        }
        ?>



    </header>
    <main hidden>
        <article class="principal">
            <section class="contenedorGalleta">
                <h1 class="s">Galletoria de <?php if (isset($_GET["user"])) echo $_GET["user"]  ?></h1>
                <div class="galleta">
                    <div class="sombra"></div>
                    <img id='galletaClicks' class='animacion-galleta' onclick='animacion()' src='images/galleta2.png'>
                </div>
                <h2 class="s cantidadGalletas">Cantidad de galletorias: <span id="cantidubi"><?php echo $cantidadGalletas ?></span></h2>
                <p class="s">Galletorias por click: <span id="cpc"><?php echo $cpc ?></span></p>
                <p class="s">Autogalletoriers: <span id="auto"><?php echo $galletoriers ?></span></p>
            </section>
            <section class="mejoras s">
                <div class="contenedorTabla">
                    <table>
                        <tr>
                            <th>50 G</th>
                            <th>1500 G</th>
                            <th>5000 G</th>
                        </tr>
                        <tr>
                            <td><button onclick="actualizarCpc(1, 50, this)">+1 CPC</button></td>
                            <td><button onclick="actualizarCpc(5, 1500, this)">+5 CPC</button></td>
                            <td><button onclick="autoclicker(1, 5000, this)">+1 Auto</button></td>
                        </tr>
                    </table>
                </div>
                <div class="guga">
                    <form id="formularioGalletas" action="actualizar_cantidad.php" method="POST">
                        <input hidden type="number" id="guardarCantidad" name="guardarCantidad" required>
                        <input hidden type="number" id="cpcGuardar" name="cpcGuardar" required>
                        <input hidden type="number" id="galletoriersGuardar" name="galletoriersGuardar" required>
                        <input hidden type="text" id="user" name="user" value=<?php echo $nick ?> required>
                        <input class="botonForm" type="button" value="Guardar" onclick="guardarCantidadJs()">
                    </form>
                </div>
            </section>
        </article>
    </main>
</body>

</html>