<?php 
$cantidadGalletas = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <h1 class="s">cookie clicker</h1>
    </header>
    <main>
        <article>
            <section class="contenedorGalleta">
                <h1 class="s">Galletoria</h1>
                <div class="sombra"></div>
                <?php
                echo "<img id='galletaClicks' class='animacion-galleta' onclick='animacion()' src='images/galleta2.png'>"
                ?>
                
                <h2 class="s">Cantidad de galletorias:<?php echo $cantidadGalletas ?></h2>
            </section>
        </article>

    </main>
    <footer>

    </footer>
</body>

</html>