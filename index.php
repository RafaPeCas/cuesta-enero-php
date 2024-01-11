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
    <link rel="shortcut icon" href="images/galleta2.png" type="image/x-icon">
    <title>Galletoria</title>
</head>

<body>
    <header class="blubla">
        <h1>Galletoria</h1>
        <?php
        $nick = "";
        $cantidadGalletas = 0;
        $galletoriers = 0;
        $cpc = 1;
        $galletoriersAfk = 0;
        if (!isset($_GET["user"])) {
            echo '<form class="insertarNombre" action="index.php" method="get">
                    <label for="user">Nombre de Usuario:</label>
                    <input type="text" id="user" name="user" required>
                    <input type="submit" value="Enviar" onclick="empezar()">
                </form>';
        } else {
            echo "<div hidden>";
            try {
                $servername = "localhost"; //cambiar a mysql
                $username = "root";
                $password = "";
                $database = "galletoria";

                $conn = new mysqli($servername, $username, $password, $database); //añadir 3306 al final

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
                        $galletoriersAfk = $row["galletoriersAfk"];
                        $lastDate = DateTime::createFromFormat('Y-m-d H:i:s', $row["ultimaCon"]);
                        $f = new DateTime();
                        $cantidadGalletas += round((abs($f->getTimestamp() - $lastDate->getTimestamp()) * ($galletoriersAfk * 0.1)));
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
    <!-- Hacer trampas está muy pero que muy feo -->
    <main hidden>
        <article class="principal">
            <section class="contenedorGalleta">
                <h1 class="s">Galletoria de <?php if (isset($_GET["user"])) echo $_GET["user"]  ?></h1>
                <div class="galleta">
                    <div class="sombra"></div>
                    <img id='galletaClicks' draggable="false" class='animacion-galleta' onclick='animacion()' onmouseleave="soltar()" onmousedown="pulsar()" onmouseup="soltar()" src='images/galleta2.png'>
                </div>
                <h2 class="s cantidadGalletas">Cantidad de galletorias: <span id="cantidubi"><?php echo $cantidadGalletas ?></span></h2>
                <p class="s">Galletorias por click: <span id="cpc"><?php echo $cpc ?></span></p>
                <p class="s">Autogalletoriers: <span id="auto"><?php echo $galletoriers ?></span></p>
                <p class="s">AutogalletoriersAFK: <span id="afk"><?php echo $galletoriersAfk * 0.1 ?></span></p>
                <?php
                if ($nick != "") {
                    echo '<div class="guga">
<form id="formularioGalletas" action="actualizar_cantidad.php" method="POST">
    <input hidden type="number" id="guardarCantidad" name="guardarCantidad" required>
    <input hidden type="number" id="cpcGuardar" name="cpcGuardar" required>
    <input hidden type="number" id="galletoriersGuardar" name="galletoriersGuardar" required>
    <input hidden type="text" id="user" name="user" value=' . $nick . ' required>
    <input hidden type="number" id="galletoriersAfkGuardar" name="galletoriersAfkGuardar" required>
    <input class="botonForm" type="button" value="Guardar" onclick="guardarCantidadJs()">
</form>
</div>';
                }
                ?>

            </section>
            <section class="mejoras s">
                <div class="info">
                    <p id="infoMsg">
                        Bienvenido a la tienda de Galletoria
                    </p>
                </div>
                <div class="contenedorTabla">
                    <table>
                        <tbody>
                            <tr>
                                <th></th>
                                <th>50</th>
                                <th>230</th>
                                <th>450</th>
                                <th>850</th>
                            </tr>
                            <tr>
                                <th>Galletorias por click</th>
                                <td><button onclick="actualizarCpc(1, 50, this)">+1</button></td>
                                <td><button onclick="actualizarCpc(5, 230, this)">+5</button></td>
                                <td><button onclick="actualizarCpc(10, 450, this)">+10</button></td>
                                <td><button onclick="actualizarCpc(20, 850, this)">+20</button></td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>5000</th>
                                <th>24000</th>
                                <th>45000</th>
                                <th>90000</th>
                            </tr>
                            <tr>
                                <th>Galletoriers</th>
                                <td><button onclick="autoclicker(1, 5000, this)">+1</button></td>
                                <td><button onclick="autoclicker(5, 24000, this)">+5</button></td>
                                <td><button onclick="autoclicker(10, 45000, this)">+10</button></td>
                                <td><button onclick="autoclicker(20, 90000, this)">+20</button></td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>150</th>
                                <th>700</th>
                                <th>1400</th>
                                <th>2700</th>
                            </tr>
                            <tr>
                                <th>Galletoriers dimensionales</th>
                                <td><button onclick="actualizarAfk(1, 150, this)">+0.1</button></td>
                                <td><button onclick="actualizarAfk(5, 700, this)">+0.5</button></td>
                                <td><button onclick="actualizarAfk(10, 1400, this)">+1</button></td>
                                <td><button onclick="actualizarAfk(20, 2700, this)">+2</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="info m">
                    <ul>
                        <li>
                            <p>Aumenta la cantidad de galletas que consigues por cada click con la primera mejora</p>
                        </li>
                        <li>
                            <p>Los galletoriers clicaran por ti mientras estés jugando para aumentar tus galletas sin esfuerzo</p>
                        </li>
                        <li>
                            <p>Los galletoriers dimensionales son unos galletoriers especiales que trabajarán para ti mientras estás desconectado, pero a diferencia de los normales, cada uno te da 0.1 galleta por segundo</p>
                        </li>
                        <li>
                            <p>Con el botón de guardar, guardarás tu progreso para la próxima vez que entres con tu nick</p>
                        </li>
                    </ul>
                </div>
            </section>
        </article>
    </main>
</body>

</html>