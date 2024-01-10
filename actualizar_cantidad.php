<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "galletoria";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    $nick = isset($_POST["user"]) ? $_POST["user"] : "";
    $nuevaCantidad = isset($_POST["guardarCantidad"]) ? $_POST["guardarCantidad"] : 0;
    $nuevoCpc = isset($_POST["cpcGuardar"]) ? $_POST["cpcGuardar"] : 1;  
    $nuevoGalletoriers = isset($_POST["galletoriersGuardar"]) ? $_POST["galletoriersGuardar"] : 0;  

    $sql = "UPDATE usuarios SET 
                cantidadGalletas = $nuevaCantidad,
                cpc = $nuevoCpc,
                galletoriers = $nuevoGalletoriers
            WHERE nick = '$nick'";


    if ($conn->query($sql) === TRUE) {
        echo "Actualización exitosa para el usuario $nick. Nueva cantidad de galletas: $nuevaCantidad";
    } else {
        throw new Exception("Error al actualizar la cantidad de galletas: " . $conn->error);
    }

    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: index.php?user=$nick");
