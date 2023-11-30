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

    //funcionalidad para los checkbox primeros

    const filas = document.querySelectorAll('.baremable tr');

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
            const children = Array.from(this.parentNode.parentNode.children);
            // Si el checkbox está marcado, habilita la fila
            if (this.checked) {
                children.forEach(child => {
                    const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                    if (!checkbox) {
                        child.classList.remove('disabled');
                    }
                });
            } else {
                // Si el checkbox no está marcado, deshabilita la fila
                children.forEach(child => {
                    const checkbox = child.querySelector('input[type="checkbox"][name="habilitador"]');
                    if (!checkbox) {
                        child.classList.add('disabled');
                    }
                });
            }
        });
    });

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
        }

        //guardar la convocatoria
        const convocatoria = {
            proyecto: proyecto.value,
            movilidades: movilidades.value,
            tipo: tipo.value,
            destino: destino.value,
            fechaInicio: fechaInicio.value,
            fechaFin: fechaFin.value,
            fecha_inicio_prueba: fecha_inicio_prueba.value,
            fecha_fin_prueba: fecha_fin_prueba.value,
            fecha_listado_provisional: fecha_listado_provisional.value,
            fecha_listado_definitivo: fecha_listado_definitivo.value
        }

        fetch('http://virtual.administracion.com/API/apiConvocatoria.php', {
            method: 'POST',
            body: JSON.stringify(convocatoria),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(x => x.json())
            .then(y => {
                // Obtener la ID de la convocatoria recién creada
                const convocatoriaId = y.id;

                // Crear los datos para apiConvocatoria_baremo y apiConvocatoria_baremo_idioma
                const baremoData = {
                    idConvocatoria: "",
                    idItem_baremables: "",
                    maximo: "",
                    minimo: "",
                    presenta: "",
                    requerido: ""

                };

                const idiomaData = {
                    idConvocatoria: "",
                    idItem_baremables: "",
                    idNivel: "",
                    puntos: ""

                };

                // Enviar los datos a apiConvocatoria_baremo
                fetch(`http://virtual.administracion.com/API/apiConvocatoria_baremo.php?id=${convocatoriaId}`, {
                    method: 'POST',
                    body: JSON.stringify(baremoData),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                // Enviar los datos a apiConvocatoria_baremo_idioma
                fetch(`http://virtual.administracion.com/API/apiConvocatoria_baremo_idioma.php?id=${convocatoriaId}`, {
                    method: 'POST',
                    body: JSON.stringify(idiomaData),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
            })

    });



});