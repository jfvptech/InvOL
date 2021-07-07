function ver() {
    password = document.getElementById("pswd");
    password.type = "text";
    setTimeout(nover, 2000)
}

function nover() {
    password = document.getElementById("pswd");
    password.type = "password";
}


function nuevopass() {
    $('#npass').modal();

}

function cerrar() {

    window.location.href = '../controlador/cierraSesion';
}

function consultas() {

    window.location.href = 'consultas';
}

function entradas() {

    window.location.href = 'entradas';
}

function salidas() {

    window.location.href = 'salidas';
}

function inventarios() {

    window.location.href = 'inventarios';
}

function cargue() {

    window.location.href = '../modelo/FormatoCargue';
}

function regresar() {
    window.location.href = 'admin';
}

function regresar2() {
    window.location.href = 'usuarios';
}

function usuarios() {

    window.location.href = 'editaUsuarios';
}

$(document).ready(function () {
    $('#centros').select2();
});

$(document).ready(function () {
    $('#centros2').select2();
});

$(document).ready(function () {
    $('.mensaje').tooltip();
});

$(document).ready(function () {
    document.getElementById("spinner").style.display = 'none';
});

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }else{
                    $("#modSpinner").modal('toggle');
                }
                if (!document.getElementById('nombre').innerHTML.includes('FormatoCargue')) {
                    document.getElementById('nombre').innerHTML = 'Por favor carga el archivo FormatoCargue.xlsx.';
                    document.getElementById('nombre').style.color = "red";
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function () {
    $('#file').change(function () {
        var file = $(this)[0].files;
        var name = document.getElementById('file').files[0].name;
        var cant = file.length
        var tamanio;
        var tamFinal = 0;
        for (var i = 0; i < cant; i++) {
            tamanio = this.files[i];
            tamFinal += tamanio.size;
        }
        if (tamFinal > 20000000) {
            $(document).ready(function () {
                $('#tamax').modal('toggle')
            });
            $(this).val = "";
            document.getElementById('nombre').innerHTML = '';
        } else {
            document.getElementById('nombre').style.color = "green";
            document.getElementById('nombre').innerHTML = name;
        }
    });
});

// script para fondo en movimiento login

window.onload = function () {
    document.body.classList.remove('is-preload');
}

window.ontouchmove = function () {
    return false;
}

window.onorientationchange = function () {
    document.body.scrollTop = 0;
}

