//comprueba si esta relleno el input
HTMLInputElement.prototype.relleno = function () {
    var respuesta = false;
    if (this.value != "") {
        respuesta = true;
    }
    return respuesta;
}
//comprueba el dni
HTMLInputElement.prototype.dni = function () {
    var respuesta = false;
    if (this.value != "") {
        const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

        var partes = (/^(\d{8})([TRWAGMYFPDXBNJZSQVHLCKE])$/i).exec(this.value);
        if (partes) {
            respuesta = (letras[partes[1] % 23] === partes[2].toUpperCase());
        }
    }
    return respuesta;
}
//comprueba la edad
HTMLInputElement.prototype.edad = function () {
    var respuesta = false;
    if (this.value == parseInt(this.value) && this.value >= 0 && this.value < 150) {
        respuesta = true;
    }
    return respuesta;
}
//comprueba si esta seleccionado
HTMLInputElement.prototype.seleccionado = function () {
    var respuesta = false;
    var name=this.name;
    if(this.form[name].value!=""){
        respuesta = true;
    }
    return respuesta;
}
//comprueba el email
HTMLInputElement.prototype.email = function () {
    var respuesta = false;
    if (this.value != "") {
        var partes = (/^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}$/).exec(this.value);
        if (partes) {
            respuesta = true;
        }
    }
    return respuesta;
}
//comprueba el telefono
HTMLInputElement.prototype.telefono = function () {
    var respuesta = false;
    if (this.value != "") {
        var partes = (/^(\d{9})$/).exec(this.value);
        if (partes) {
            respuesta = true;
        }
    }
    return respuesta;
}
//comprueba la fecha
HTMLInputElement.prototype.fecha = function () {
    var respuesta = false;
    if (this.value != "") {
        //fechas americanas por eso pongo el año al principio
        var partes = (/^(\d{4})-(\d{2})-(\d{2})$/).exec(this.value);
        if (partes) {
            respuesta = true;
        }
    }
    return respuesta;
}
//comprueba el numero
HTMLInputElement.prototype.numero = function () {
    var respuesta = false;
    if (this.value != "") {
        var partes = (/^(\d+)$/).exec(this.value);
        if (partes && parseInt(partes[1]) > 0) {
            respuesta = true;
        }
    }
    return respuesta;
}
//comprueba el pdf
HTMLInputElement.prototype.pdfSeleccionado = function () {
    var respuesta = false;
    if (this.files.length > 0) {
        var fileName = this.files[0].name;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substring(idxDot).toLowerCase();
        if (extFile=="pdf"){
            respuesta = true;
        }
    }
    return respuesta;
}
//valida el contenido de fildset
HTMLFieldSetElement.prototype.valida = function () {
    // Buscar todos los checkboxes en el fieldset
    var checkboxes = this.querySelectorAll('input[type="checkbox"]');

    // Verificar si al menos uno está marcado
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            // Si al menos uno está marcado, la validación es exitosa
            return true;
        }
    }

    // Si ninguno está marcado, la validación falla
    return false;
}
//comprueba si esta relleno el select
HTMLSelectElement.prototype.relleno = function () {
    var respuesta = false;
    // Si el select tiene un valor que no es el valor predeterminado (deshabilitado), es válido
    if (this.value != this.querySelector('option[disabled]').value) {
        respuesta = true;
    }
    return respuesta;
};
//valida el formulario
HTMLFormElement.prototype.valida = function () {
    var elementos = this.querySelectorAll("input[data-valida]:not(td.disabled > *),select[data-valida],fieldset[data-valida]");
    var respuesta = true;
    let n = elementos.length;
    for (let i = 0; i < n; i++) {

        //si no esta visible no se valida
        if (elementos[i].offsetParent === null) continue;

        //coge los datos que tengan el dataset valida
        let tipo = elementos[i].getAttribute("data-valida");
        var aux=elementos[i][tipo]();
        if(aux){
            elementos[i].classList.add("valido");
            elementos[i].classList.remove("invalido");

            // Remover la clase 'valido' después de 2 segundos
            setTimeout(function() {
                elementos[i].classList.remove("valido");
            }, 2000);
        }else{
            elementos[i].classList.remove("valido");
            elementos[i].classList.add("invalido");

             // Remover la clase 'invalido' después de 2 segundos
             setTimeout(function() {
                elementos[i].classList.remove("invalido");
            }, 2000);
        }
        respuesta = respuesta && aux;
    }
    return respuesta;
}