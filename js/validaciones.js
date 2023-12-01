HTMLInputElement.prototype.relleno = function () {
    var respuesta = false;
    if (this.value != "") {
        respuesta = true;
    }
    return respuesta;
}

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

HTMLInputElement.prototype.edad = function () {
    var respuesta = false;
    if (this.value == parseInt(this.value) && this.value >= 0 && this.value < 150) {
        respuesta = true;
    }
    return respuesta;
}
HTMLInputElement.prototype.seleccionado = function () {
    var respuesta = false;
    var name=this.name;
    if(this.form[name].value!=""){
        respuesta = true;
    }
    return respuesta;
}

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

HTMLInputElement.prototype.numero = function () {
    var respuesta = false;
    if (this.value != "") {
        var partes = (/^(\d+)$/).exec(this.value);
        if (partes) {
            respuesta = true;
        }
    }
    return respuesta;
}

HTMLSelectElement.prototype.relleno = function () {
    var respuesta = false;
    // Si el select tiene un valor que no es el valor predeterminado (deshabilitado), es válido
    if (this.value != this.querySelector('option[disabled]').value) {
        respuesta = true;
    }
    return respuesta;
};

HTMLFormElement.prototype.valida = function () {
    var elementos = this.querySelectorAll("input[data-valida]:not(td.disabled > *),select[data-valida]");
    var respuesta = true;
    let n = elementos.length;
    for (let i = 0; i < n; i++) {
        let tipo = elementos[i].getAttribute("data-valida");
        var aux=elementos[i][tipo]();
        if(aux){
            elementos[i].classList.add("valido");
            elementos[i].classList.remove("invalido");
        }else{
            elementos[i].classList.remove("valido");
            elementos[i].classList.add("invalido");
        }
        respuesta = respuesta && aux;
    }
    return respuesta;
}