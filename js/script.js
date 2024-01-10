"use strict"

let cantidadGalletorias = parseInt(cantidubi.innerHTML);
let suma = parseInt(cpc.innerHTML);
let galletoriers = parseInt(auto.innerHTML);

function animacion() {
    galletear()
    let galleta = document.getElementById('galletaClicks');
    galleta.classList.add('escalar');
    setTimeout(function () {
        galleta.classList.remove('escalar');
    }, 100);

}

if (document.querySelector('.insertarNombre') === null) {
    empezar();
}

if (document.querySelector("#error") != null) {
    formularioGalletas.setAttribute("hidden", "")
}

function empezar() {
    document.querySelector('main').removeAttribute('hidden')
    if (document.querySelector('.insertarNombre') != null) {
        document.querySelector('.insertarNombre').setAttribute('hidden', "")
    }
}

function galletear() {
    cantidadGalletorias += suma
    actualizarVistaGalletoria()
}

function actualizarVistaGalletoria() {
    document.querySelector("#cantidubi").innerHTML = cantidadGalletorias
}

function guardarCantidadJs() {
    document.getElementById("guardarCantidad").value = cantidadGalletorias;
    cpcGuardar.value=suma;
    galletoriersGuardar.value=galletoriers;
    document.getElementById("formularioGalletas").submit();
}

function actualizarCpc(cantidad, precio, boton) {
    if (precio > cantidadGalletorias) {
        boton.classList.add("nonono")
        setTimeout(function () {
            boton.classList.remove("nonono")
        }, 300);
    } else {
        cantidadGalletorias -= precio;
        actualizarVistaGalletoria()
        suma += cantidad;
        actualizarVistaCpc()
    }

}

if (galletoriers > 0) {
    ejecutarGalletear();
}

function autoclicker(cantidad, precio, boton) {
    if (precio > cantidadGalletorias) {
        boton.classList.add("nonono");
        setTimeout(function () {
            boton.classList.remove("nonono");
        }, 300);
    } else {
        cantidadGalletorias -= precio;
        actualizarVistaGalletoria();
        galletoriers += cantidad;
        actualizarVistaAuto();
    }
}

function ejecutarGalletear() {
    setInterval(function () {
        galletear();
    }, 1000);
}

function actualizarVistaCpc() {
    cpc.innerHTML = suma;
}

function actualizarVistaAuto() {
    auto.innerHTML = galletoriers;
}

