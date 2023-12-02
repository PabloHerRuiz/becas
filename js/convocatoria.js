window.addEventListener('load', function () {

    const proyecto = document.getElementById('proyecto');
    const movilidades = document.getElementById('movilidades');
    const tipo = document.getElementById('tipo');
    const destino = document.getElementById('destino');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    const fecha_inicio_prueba = document.getElementById('fecha_inicio_prueba');
    const fecha_fin_prueba = document.getElementById('fecha_fin_prueba');
    const fecha_listado_provisional = document.getElementById('fecha_listado_provisional');
    const fecha_listado_definitivo = document.getElementById('fecha_listado_definitivo');
    const form = document.getElementById('formConvocatoria');
    const tablaItem = document.querySelector('.baremable tbody');
    const bodyIdioma = document.querySelector('.idioma tbody tr');
    const theadIdioma = document.querySelector('.idioma thead tr');
    const fieldDestinatario = document.getElementById('destinatarios');


    //desactivar los campos de fecha
    fechaFin.disabled = true;
    fecha_inicio_prueba.disabled = true;
    fecha_fin_prueba.disabled = true;
    fecha_listado_provisional.disabled = true;
    fecha_listado_definitivo.disabled = true;

    //cargar los proyectos
    fetch('http://virtual.administracion.com/API/apiProyecto.php')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                opcion = document.createElement("option");
                opcion.value = y[i].codProyecto;
                opcion.text = y[i].nombre;

                proyecto.appendChild(opcion);
            }
        });

    //plantillas

    // Cargar la plantilla de item una vez
    fetch("/vistas/plantillas/tablaItem.html")
        .then(x => x.text())
        .then(y => {
            plantillaItem = document.createElement("tr");
            plantillaItem.innerHTML = y;
        });

    // Cargar la plantilla de destinatarios una vez
    fetch("/vistas/plantillas/destinatario.html")
        .then(x => x.text())
        .then(y => {
            plantillaDest = document.createElement("div");
            plantillaDest.innerHTML = y;
        });

    // Cargar la plantilla de idiomas una vez
    fetch("/vistas/plantillas/idioma.html")
        .then(x => x.text())
        .then(y => {
            plantillaIdioma = document.createElement("tr");
            plantillaIdioma.innerHTML = y;
        });


    //cargar los datos con las plantillas

    //cargar idiomas
    fetch('http://virtual.administracion.com/API/apiNivel.php')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                var idiomas = plantillaIdioma.cloneNode(true);

                var th = document.createElement('th');
                var nivel = idiomas.querySelector(".nIdioma");
                nivel.textContent = y[i].nombre;
                th.appendChild(nivel);
                theadIdioma.appendChild(th);

                var nota = document.createElement('td');
                nota = idiomas.querySelector("td");
                nota.querySelector('input').id = y[i].idNivel;
                nota.querySelector('input').setAttribute('data-valida', 'numero');
                nota.querySelector('input').name = "nota" + y[i].nombre;
                bodyIdioma.appendChild(nota);
            }
        });

    //cargar los destinatarios

    fetch('http://virtual.administracion.com/API/apiDestinatario.php')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                var destinatario = plantillaDest.cloneNode(true);

                var checkbox = destinatario.querySelector('input[type="checkbox"][name="destinos"]');
                checkbox.id = y[i].codGrupo;
                checkbox.value = y[i].idDestinatarios;

                destinatario.querySelector(".codGrupo").innerHTML = y[i].codGrupo;
                destinatario.title = y[i].nombre;

                fieldDestinatario.appendChild(destinatario);
            }
        });



    // Cargar los items

    fetch('http://virtual.administracion.com/API/apiItem.php')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                var itemBaremable = plantillaItem.cloneNode(true);

                var item = itemBaremable.querySelector(".item");

                item.innerHTML = y[i].nombre;
                item.value = y[i].idItem_baremables;

                var checkbox = itemBaremable.querySelector('input[type="checkbox"][name="habilitador"]');
                checkbox.id = y[i].nombre + "CB";

                var label = itemBaremable.querySelector('label');
                label.htmlFor = y[i].nombre + "CB";

                tablaItem.appendChild(itemBaremable);
            }

            //funcionalidad para los checkbox primeros

            const filas = document.querySelectorAll('.baremable tbody tr');

            // Añade la clase disabled a todos los elementos de cada fila, excepto al checkbox 'habilitador'
            filas.forEach(fila => {
                const children = Array.from(fila.children);
                children.forEach(child => {
                    const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                    if (!checkbox) {
                        child.classList.add('disabled');
                    }
                });
            });

            const checkboxes = document.querySelectorAll('.baremable input[type="checkbox"][name="habilitador"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    var img = this.nextElementSibling.querySelector('.checkbox-image');
                    const children = Array.from(this.parentNode.parentNode.children);

                    if (this.checked) {

                        //cambiamos la imagen
                        img.src = 'css/imagenes/candado-abierto.png';

                        children.forEach(child => {
                            const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                            const inputMinimo = child.querySelector('input[name="minimo"]');
                            if (!checkbox && !inputMinimo) {
                                child.classList.remove('disabled');
                            }
                        });
                    } else {

                        //cambiamos la imagen
                        img.src = 'css/imagenes/cerrar-con-llave.png';

                        children.forEach(child => {
                            const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                            const inputMinimo = child.querySelector('input[name="minimo"]');
                            const inputMaximo = child.querySelector('input[name="maximo"]');

                            if (!checkbox) {
                                child.classList.add('disabled');
                            }

                            if (inputMaximo) {
                                inputMaximo.classList.remove('valido');
                                inputMaximo.classList.remove('invalido');
                            }

                            if (inputMinimo) {
                                inputMinimo.classList.remove('valido');
                                inputMinimo.classList.remove('invalido');
                            }
                        });
                    }
                });
            });

            const idiomaCB = document.getElementById('IdiomaCB');
            const tablaIdioma = document.getElementsByClassName('idioma')[0];
            idiomaCB.addEventListener('change', function () {
                if (this.checked) {
                    tablaIdioma.style.display = "table";
                } else {
                    tablaIdioma.style.display = "none";
                    tablaIdioma.querySelectorAll('input[type="text"][data-valida="numero"]').forEach(input => {
                        input.classList.remove('valido');
                        input.classList.remove('invalido');
                    });
                }
            });


            const requisitos = document.querySelectorAll("input[type='checkbox'][name='requisito']");
            requisitos.forEach(requisito => {
                requisito.addEventListener('change', function () {
                    const inputMinimo = this.parentNode.parentNode.querySelector("input[name='minimo']");
                    if (this.checked) {
                        inputMinimo.removeAttribute('disabled');
                        inputMinimo.parentNode.classList.remove('disabled');
                    } else {
                        inputMinimo.setAttribute('disabled', '');
                        inputMinimo.parentNode.classList.add('disabled');
                    }
                });
            });
        });

    //controlar las fechas
    fechaInicio.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaActual = new Date();
        fechaActual.setHours(0, 0, 0, 0);

        if (fecha.getTime() < fechaActual.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha actual");
            fechaInicio.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha actual");
            fechaFin.disabled = false;
        }

        if (fechaFin.value) {
            fechaFin.value = "";
            fechaFin.disabled = false;
            fecha_inicio_prueba.value = "";
            fecha_inicio_prueba.disabled = true;
            fecha_fin_prueba.value = "";
            fecha_fin_prueba.disabled = true;
            fecha_listado_provisional.value = "";
            fecha_listado_provisional.disabled = true;
            fecha_listado_definitivo.value = "";
            fecha_listado_definitivo.disabled = true;           
        }
    });

    fechaFin.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaIni = new Date(fechaInicio.value);

        if (fecha.getTime() < fechaIni.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha de inicio");
            fechaFin.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha de inicio");
            fecha_inicio_prueba.disabled = false;
        }

        if (fecha_inicio_prueba.value) {
            fecha_inicio_prueba.value = "";
            fecha_inicio_prueba.disabled = false;
            fecha_fin_prueba.value = "";
            fecha_fin_prueba.disabled = true;
            fecha_listado_provisional.value = "";
            fecha_listado_provisional.disabled = true;
            fecha_listado_definitivo.value = "";
            fecha_listado_definitivo.disabled = true;    
        }

    });

    fecha_inicio_prueba.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaFinal = new Date(fechaFin.value);

        if (fecha.getTime() < fechaFinal.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha final de la convocatoria");
            fecha_inicio_prueba.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha final de la convocatoria");
            fecha_fin_prueba.disabled = false;
        }

        if (fecha_fin_prueba.value) {
            fecha_fin_prueba.value = "";
            fecha_fin_prueba.disabled = false;
            fecha_listado_provisional.value = "";
            fecha_listado_provisional.disabled = true;
            fecha_listado_definitivo.value = "";
            fecha_listado_definitivo.disabled = true; 
        }
    });

    fecha_fin_prueba.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaIniPrueba = new Date(fecha_inicio_prueba.value);

        if (fecha.getTime() < fechaIniPrueba.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha de inicio de la prueba");
            fecha_fin_prueba.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha de inicio de la prueba");
            fecha_listado_provisional.disabled = false;
        }
        if (fecha_listado_provisional.value) {
            fecha_listado_provisional.value = "";
            fecha_listado_provisional.disabled = false;
            fecha_listado_definitivo.value = "";
            fecha_listado_definitivo.disabled = true; 
        }

    });

    fecha_listado_provisional.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaFinPrueba = new Date(fecha_fin_prueba.value);

        if (fecha.getTime() < fechaFinPrueba.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha final de la prueba");
            fecha_listado_provisional.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha final de la prueba");
            fecha_listado_definitivo.disabled = false;
        }

        if (fecha_listado_definitivo.value) {
            fecha_listado_definitivo.value = "";
            fecha_listado_definitivo.disabled = false;
        }
    });

    fecha_listado_definitivo.addEventListener('change', function () {
        var fecha = new Date(this.value);

        var fechaListadoProvisional = new Date(fecha_listado_provisional.value);

        if (fecha.getTime() < fechaListadoProvisional.getTime()) {
            alert("La fecha seleccionada no puede ser anterior a la fecha del listado provisional");
            fecha_listado_definitivo.value = "";
        } else {
            console.log("La fecha ingresada no es anterior a la fecha del listado provisional");
        }
    });

    //controlamos el evento de envio del formulario

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //comprobamos los valores    
        if (form.valida()) {
            this.classList.add("valido");
            this.classList.remove("invalido");

            // Remover la clase 'valido' después de 2 segundos
            setTimeout(function () {
                form.classList.remove("valido");
            }, 2000);
            // form.submit();
        } else {
            this.classList.remove("valido");
            this.classList.add("invalido");

            // Remover la clase 'valido' después de 2 segundos
            setTimeout(function () {
                form.classList.remove("invalido");
            }, 2000);
        }
    });



});