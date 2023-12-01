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

    // Cargar los items

    fetch('http://virtual.administracion.com/API/apiItem.php')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                var itemBaremable = plantillaItem.cloneNode(true);

                var item = itemBaremable.querySelector(".item");

                item.innerHTML = y[i].nombre;
                item.value = y[i].idItem_baremables;

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

                    // Si el checkbox está marcado, habilita la fila
                    if (this.checked) {

                        //cambiamos la imagen
                        img.src = 'css/imagenes/candado-abierto.png';

                        children.forEach(child => {
                            const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                            if (!checkbox) {
                                child.classList.remove('disabled');
                            }
                        });
                    } else {
                        // Si el checkbox no está marcado, deshabilita la fila

                        //cambiamos la imagen
                        img.src = 'css/imagenes/cerrar-con-llave.png';

                        children.forEach(child => {
                            const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                            if (!checkbox) {
                                child.classList.add('disabled');
                            }
                        });
                    }
                });
            });

        })







    const idiomaCB = document.getElementById('idiomaCB');
    const tablaIdioma = document.getElementsByClassName('idioma')[0];
    idiomaCB.addEventListener('change', function () {
        if (this.checked) {
            tablaIdioma.style.display = "table";
        } else {
            tablaIdioma.style.display = "none";
        }
    });



    //controlamos el evento de envio del formulario

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //comprobamos los valores    
        if (!proyecto.value || !movilidades.value || !tipo.value || !destino.value || !fechaInicio.value || !fechaFin.value || !fecha_inicio_prueba.value || !fecha_fin_prueba.value || !fecha_listado_provisional.value || !fecha_listado_definitivo.value) {
            alert('Faltan datos por rellenar en el formulario');
            console.error('Datos del formulario no válidos');
            return;
        } else {
            form.submit();
        }


    });



});