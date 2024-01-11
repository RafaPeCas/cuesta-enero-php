"use strict"

let cantidadGalletorias = parseInt(cantidubi.innerHTML);
let suma = parseInt(cpc.innerHTML);
let galletoriers = parseInt(auto.innerHTML);
let galletoriersAfk = parseInt(afk.innerHTML*10);

function animacion() {
    galletear(1)
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
    document.querySelector("header").classList.remove("blubla");
    if (document.querySelector('.insertarNombre') != null) {
        document.querySelector('.insertarNombre').setAttribute('hidden', "")
    }
}

function galletear(multiplicador) {
    cantidadGalletorias += suma * multiplicador;
    actualizarVistaGalletoria()
}

function actualizarVistaGalletoria() {
    document.querySelector("#cantidubi").innerHTML = cantidadGalletorias
}

function guardarCantidadJs() {
    document.getElementById("guardarCantidad").value = cantidadGalletorias;
    cpcGuardar.value = suma;
    galletoriersGuardar.value = galletoriers;
    galletoriersAfkGuardar.value = galletoriersAfk;
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
        if (galletoriers <= 0) {
            ejecutarGalletear();
        }
        cantidadGalletorias -= precio;
        actualizarVistaGalletoria();
        galletoriers += cantidad;
        actualizarVistaAuto();
    }
}

function ejecutarGalletear() {
    setInterval(function () {
        galletear(galletoriers);
    }, 1000);
}

function actualizarAfk(cantidad, precio, boton){
    if (precio > cantidadGalletorias) {
        boton.classList.add("nonono");
        setTimeout(function () {
            boton.classList.remove("nonono");
        }, 300);
    } else {
        cantidadGalletorias -= precio;
        actualizarVistaGalletoria();
        galletoriersAfk += cantidad;
        actualizarVistaAfk();
    }
}

function actualizarVistaCpc() {
    cpc.innerHTML = suma;
}

function actualizarVistaAuto() {
    auto.innerHTML = galletoriers;
}

function actualizarVistaAfk(){
    let resultado = galletoriersAfk*0.1
    afk.innerHTML = resultado.toFixed(1);
}

