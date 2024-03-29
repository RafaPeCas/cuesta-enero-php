<?php
try {
    $servername = "mysql"; 
    $username = "root";
    $password = "";
    $database = "galletoria";

    $conn = new mysqli($servername, $username, $password, $database, 3306);

    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    $nick = isset($_POST["user"]) ? $_POST["user"] : "";
    $nuevaCantidad = isset($_POST["guardarCantidad"]) ? $_POST["guardarCantidad"] : 0;
    $nuevoCpc = isset($_POST["cpcGuardar"]) ? $_POST["cpcGuardar"] : 1;
    $nuevoGalletoriers = isset($_POST["galletoriersGuardar"]) ? $_POST["galletoriersGuardar"] : 0;
    $fecha = new DateTime();
    $blubla = $fecha->format('Y-m-d H:i:s');
    $nuevoGalletoriersAfk = isset($_POST["galletoriersAfkGuardar"]) ? $_POST["galletoriersAfkGuardar"] : 0;
    
    $sql = "UPDATE usuarios SET 
                    cantidadGalletas = $nuevaCantidad,
                    cpc = $nuevoCpc,
                    galletoriers = $nuevoGalletoriers,
                    ultimaCon = '$blubla',
                    galletoriersAfk = $nuevoGalletoriersAfk
                WHERE nick = '$nick'";
    

    if ($conn->query($sql) === TRUE) {

    } else {
        throw new Exception("Error al actualizar la cantidad de galletas: " . $conn->error);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
