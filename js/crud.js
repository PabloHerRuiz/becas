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
                <td class="codProyecto" data-nombre="codProyecto">${elemento.codProyecto}</td>
                <td class="movilidades" data-nombre="movilidades">${elemento.movilidades}</td>
                <td class="destinos" data-nombre="destinos">${elemento.destinos}</td>
                <td class="tipo" data-nombre="tipo">${elemento.tipo}</td>
                <td class="fecha_ini" data-nombre="fecha_ini">${elemento.fecha_ini}</td>
                <td class="fecha_fin" data-nombre="fecha_fin">${elemento.fecha_fin}</td>
                <td class="fecha_ini_pruebas" data-nombre="fecha_ini_pruebas">${elemento.fecha_ini_pruebas}</td>
                <td class="fecha_fin_pruebas" data-nombre="fecha_fin_pruebas">${elemento.fecha_fin_pruebas}</td>
                <td class="fecha_lis_provisional" data-nombre="fecha_lis_provisional">${elemento.fecha_lis_provisional}</td>
                <td class="fecha_lis_definitiva" data-nombre="fecha_lis_definitiva">${elemento.fecha_lis_definitiva}</td>` + acciones;

                tbody.appendChild(fila);
            });

            agregarEventos();
        });

    function agregarEventos() {
        var editar = document.querySelectorAll(".iconE");
        var guardar = document.querySelectorAll(".iconG");
        var borrar = document.querySelectorAll(".iconB");
        editar.forEach(function (elemento) {
            elemento.addEventListener("click", function () {
                var fila = this.closest("tr");

                var celdas = fila.querySelectorAll("td:not(.acciones,.id)");

                celdas.forEach(function (celda) {
                    var contenidoActual = celda.textContent.trim();
                    celda.dataset.contenidoOriginal = contenidoActual;
                });

                celdas.forEach(function (celda) {
                    var contenidoOriginal = celda.dataset.contenidoOriginal;
                    var nombreCampo = celda.getAttribute("data-nombre");

                    if (nombreCampo.includes("fecha")) {
                        var fecha = new Date(contenidoOriginal);
                        if (fecha > new Date()) {
                            celda.innerHTML = `<input type="date" value="${contenidoOriginal}" style="width: 100%; box-sizing: border-box;">`;
                        }
                    } else {
                        celda.innerHTML = `<input type="text" value="${contenidoOriginal.replace(/"/g, '&quot;')}" style="width: 100%; box-sizing: border-box;">`;
                    }
                });

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


                // Obtén las fechas de los inputs en lugar de las celdas
                var fecha_ini = new Date(fila.querySelector(".fecha_ini input").value);
                var fecha_fin = new Date(fila.querySelector(".fecha_fin input").value);
                var fecha_ini_pruebas = new Date(fila.querySelector(".fecha_ini_pruebas input").value);
                var fecha_fin_pruebas = new Date(fila.querySelector(".fecha_fin_pruebas input").value);
                var fecha_lis_provisional = new Date(fila.querySelector(".fecha_lis_provisional input").value);
                var fecha_lis_definitiva = new Date(fila.querySelector(".fecha_lis_definitiva input").value);

                // Verificar que las fechas están en el orden correcto
                if (fecha_ini > fecha_fin || fecha_fin > fecha_ini_pruebas || fecha_ini_pruebas > fecha_fin_pruebas || fecha_fin_pruebas > fecha_lis_provisional || fecha_lis_provisional > fecha_lis_definitiva) {
                    alert("Comprueba que las fechas no sean inferiores a las anteriores");
                    console.error("Comprueba que las fechas no sean inferiores a las anteriores");
                    return;
                }


                // Objeto para almacenar los datos actualizados de la fila
                var actualiza = {};

                // Lista para almacenar referencias a los inputs
                var inputs = [];

                for (var i = 0; i < celdas.length; i++) {
                    var celda = celdas[i];
                    var nombreCampo = celda.getAttribute("data-nombre");
                    var inputElement = celda.querySelector("input");
                    if (inputElement) {
                        var nuevoContenido = inputElement.value;

                        celda.textContent = nuevoContenido;

                        inputs.push(inputElement);
                    }

                    actualiza[nombreCampo] = nuevoContenido;
                }

                // Elimina todos los inputs de la lista
                inputs.forEach(function (input) {
                    if (input && input.parentNode) {
                        input.parentNode.removeChild(input);
                    }
                });

                var id = fila.querySelector(".id").textContent.trim();
                var fecha_ini = fila.querySelector(".fecha_ini").textContent.trim();
                var fecha_fin = fila.querySelector(".fecha_fin").textContent.trim();
                var fecha_ini_pruebas = fila.querySelector(".fecha_ini_pruebas").textContent.trim();
                var fecha_fin_pruebas = fila.querySelector(".fecha_fin_pruebas").textContent.trim();
                var fecha_lis_provisional = fila.querySelector(".fecha_lis_provisional").textContent.trim();
                var fecha_lis_definitiva = fila.querySelector(".fecha_lis_definitiva").textContent.trim();
                actualiza["id"] = id;
                actualiza["fecha_ini"] = fecha_ini;
                actualiza["fecha_fin"] = fecha_fin;
                actualiza["fecha_ini_pruebas"] = fecha_ini_pruebas;
                actualiza["fecha_fin_pruebas"] = fecha_fin_pruebas;
                actualiza["fecha_lis_provisional"] = fecha_lis_provisional;
                actualiza["fecha_lis_definitiva"] = fecha_lis_definitiva;


                var actualizaJson = JSON.stringify(actualiza);

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