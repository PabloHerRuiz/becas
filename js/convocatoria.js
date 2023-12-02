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
    const fieldDestinatario = document.getElementById('destinatarios');

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
        })

    // cargar tablaItem

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
            destinatario.title=y[i].nombre;

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

                            if(inputMaximo){
                                inputMaximo.classList.remove('valido');
                                inputMaximo.classList.remove('invalido');
                            }

                            if(inputMinimo){
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

    //controlamos el evento de envio del formulario

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //comprobamos los valores    
        if (form.valida()) {
            this.classList.add("valido");
            this.classList.remove("invalido");
            // form.submit();
        } else {
            this.classList.remove("valido");
            this.classList.add("invalido");
        }
    });



});