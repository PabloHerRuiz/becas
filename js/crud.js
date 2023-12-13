window.addEventListener('load', function () {

    //CRUD
    var tbody = document.getElementById("bodyTabla");

    fetch('http://virtual.administracion.com/API/apiConvocatoria.php?todas=1')
        .then(x => x.json())
        .then(y => {
            y.forEach(function (elemento) {
                var fila = document.createElement("tr");
                var fechaIni = new Date(elemento.fecha_ini);
                var fechaActual = new Date();

                var acciones = fechaIni <= fechaActual ?
                    `<td class="acciones"><a><img class="iconE icon" src="css/iconos/editar.png"><img class="iconG icon" src="css/iconos/guardar.png"></a></td>` :
                    `<td class="acciones"><a><img class="iconE icon" src="css/iconos/editar.png"><img class="iconB icon" src="css/iconos/borrar.png"><img class="iconG icon" src="css/iconos/guardar.png"></a></td>`;


                fila.innerHTML = `<td class="id">${elemento.idConvocatorias}</td>
                <td data-nombre="codProyecto">${elemento.codProyecto}</td>
                <td data-nombre="movilidades">${elemento.movilidades}</td>
                <td data-nombre="destinos">${elemento.destinos}</td>
                <td data-nombre="tipo">${elemento.tipo}</td>
                <td data-nombre="fecha_ini">${elemento.fecha_ini}</td>
                <td data-nombre="fecha_fin">${elemento.fecha_fin}</td>
                <td data-nombre="fecha_ini_pruebas">${elemento.fecha_ini_pruebas}</td>
                <td data-nombre="fecha_fin_pruebas">${elemento.fecha_fin_pruebas}</td>
                <td data-nombre="fecha_lis_provisional">${elemento.fecha_lis_provisional}</td>
                <td data-nombre="fecha_lis_definitiva">${elemento.fecha_lis_definitiva}</td>` + acciones;

                tbody.appendChild(fila);
            });


            // Agregar el evento de clic a los iconos después de que se cargue la tabla
            agregarEventos();
        });

    function agregarEventos() {
        var editar = document.querySelectorAll(".iconE");
        var guardar = document.querySelectorAll(".iconG");
        var borrar = document.querySelectorAll(".iconB");
        editar.forEach(function (elemento) {
            elemento.addEventListener("click", function () {
                var fila = this.closest("tr");

                // Obtén todas las celdas de la fila, excluyendo la celda de Acciones
                var celdas = fila.querySelectorAll("td:not(.acciones,.id)");

                // Itera sobre las celdas y almacena el contenido original en una propiedad de datos
                celdas.forEach(function (celda) {
                    var contenidoActual = celda.textContent.trim();
                    celda.dataset.contenidoOriginal = contenidoActual;
                });

                // Itera sobre las celdas y ajusta su contenido durante la edición
                celdas.forEach(function (celda) {
                    var contenidoOriginal = celda.dataset.contenidoOriginal;
                    var nombreCampo = celda.getAttribute("data-nombre");

                    if (nombreCampo.includes("fecha")) {
                        // Ajusta el contenido de la celda con un input de tipo fecha
                        celda.innerHTML = `<input type="date" value="${contenidoOriginal}" style="width: ${celda.clientWidth}px; box-sizing: border-box;">`;
                    } else {
                        // Ajusta el contenido de la celda con un input de tipo texto
                        celda.innerHTML = `<input type="text" value="${contenidoOriginal.replace(/"/g, '&quot;')}" style="width: ${celda.clientWidth}px; box-sizing: border-box;">`;
                    }
                });

                // Muestra el icono de guardar y oculta el icono de editar
                fila.querySelector(".iconE").style.display = "none";
                fila.querySelector(".iconG").style.display = "inline";
                if (fila.querySelector(".iconB")) {
                    fila.querySelector(".iconB").style.display = "none";
                }
            });
        });

        guardar.forEach(function (elemento) {
            elemento.addEventListener("click", function () {
                var fila = elemento.closest("tr");
                var celdas = fila.querySelectorAll("td:not(.acciones)");

                // Objeto para almacenar los datos actualizados de la fila
                var actualiza = {};

                // Lista para almacenar referencias a los inputs
                var inputs = [];

                // Utilizamos un bucle normal
                for (var i = 0; i < celdas.length; i++) {
                    var celda = celdas[i];
                    var nombreCampo = celda.getAttribute("data-nombre"); // Nombre del campo asociado a la celda
                    var inputElement = celda.querySelector("input");
                    if (inputElement) {
                        var nuevoContenido = inputElement.value;

                        // Asigna el nuevo contenido a la celda
                        celda.textContent = nuevoContenido;

                        // Agrega el input a la lista
                        inputs.push(inputElement);
                    }

                    // Agregar el campo y su valor al objeto actualiza
                    actualiza[nombreCampo] = nuevoContenido;
                }

                // Elimina todos los inputs de la lista
                inputs.forEach(function (input) {
                    if (input && input.parentNode) {
                        input.parentNode.removeChild(input);
                    }
                });

                var id = fila.querySelector(".id").textContent.trim();
                actualiza["id"] = id;

                // Convertir el objeto actualiza a formato JSON
                var actualizaJson = JSON.stringify(actualiza);
                console.log(actualizaJson);

                // Realiza la solicitud PUT
                fetch("http://virtual.administracion.com/API/apiConvocatoria.php", {
                    method: "PUT",
                    body: actualizaJson,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(x => x.text())
                    .then(y => {
                        console.log(y);
                    });

                fila.querySelector(".iconE").style.display = "inline";
                fila.querySelector(".iconG").style.display = "none";
                if (fila.querySelector(".iconB")) {
                    fila.querySelector(".iconB").style.display = "inline";
                }
            });
        });


        borrar.forEach(function (elemento) {
            elemento.addEventListener("click", function () {
                var fila = elemento.closest("tr");

                var id = fila.querySelector(".id").textContent.trim();

                // Realiza la solicitud PUT
                fetch("http://virtual.administracion.com/API/apiConvocatoria.php?id=" + id, {
                    method: "DELETE"
                })
                    .then(x => x.text())
                    .then(y => {
                        console.log(y);
                        fila.remove();
                    });
            });
        });

    }
});