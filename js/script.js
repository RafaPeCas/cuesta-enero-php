function animacion() {
    // Obtener la referencia a la imagen
    var galleta = document.getElementById('galletaClicks');

    // Agregar clase para iniciar la animación
    galleta.classList.add('escalar');

    // Retrasar la eliminación de la clase para restaurar el tamaño original
    setTimeout(function() {
        // Eliminar la clase después de la animación
        galleta.classList.remove('escalar');
    }, 100); // 500 milisegundos (0.5 segundos)
}

function sombrear(){
    
}