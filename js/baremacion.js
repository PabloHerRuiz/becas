window.addEventListener('load', function () {

    const barecontainer = document.getElementById('bare-container');
    var url = new URL(window.location.href);

    var id = url.searchParams.get("id");

    //cargamos la plantilla de una
    fetch('/vistas/plantillas/listaBaremacion.html')
        .then(x => x.text())
        .then(y => {
            plantillaBare = document.createElement("div");
            plantillaBare.innerHTML = y;
        });

    //cogemos los datos de las convocatorias
    fetch('http://virtual.administracion.com/API/apiConvocatoria.php?baremacion=1')
        .then(x => x.json())
        .then(y => {
            i = 1;
            y.convocatorias.forEach(convocatoriasInfo => {

                //cargamos todo
                var bare = plantillaBare.cloneNode(true);

                bare.setAttribute("data-id", convocatoriasInfo.idConvocatorias);

                var destinos = bare.querySelector(".des");
                var movilidades = bare.querySelector(".mov");
                var tipo = bare.querySelector(".tip");
                var input = bare.querySelector("input");
                var h2 = bare.querySelector("h2");

                destinos.innerHTML = convocatoriasInfo.destinos;
                input.id = "despliega" + i;
                movilidades.innerHTML = convocatoriasInfo.movilidades;

                h2.addEventListener("click", function () {
                    const checkbox = this.previousElementSibling;
                    checkbox.checked = !checkbox.checked;
                });

                if (convocatoriasInfo.tipo == 1) {
                    tipo.innerHTML = "Larga Duración";
                } else if (convocatoriasInfo.tipo == 2) {
                    tipo.innerHTML = "Corta Duración";
                }

                var ul = bare.querySelector("ul");
                ul.id = "ul" + i;

                var solicitudesCount = 0;

                y.solicitudes.forEach(function (solicitud) {
                    if (solicitud.idConvocatorias === convocatoriasInfo.idConvocatorias) {
                        var li = document.createElement("li");
                        li.innerHTML = solicitud.nombre + " " + solicitud.apellidos;
                        li.id = solicitud.idCandidato;
                        ul.appendChild(li);
                        solicitudesCount++;

                        (function (li) {
                            li.addEventListener('click', function () {
                                var iframe = document.createElement('iframe');
                                iframe.src = "/vistas/plantillas/Solicitud ErasmusCFGM23-24.html";
                                iframe.width = "100%";
                                iframe.height = "100%";
                                // contenedor.appendChild(iframe);

                                //fondo modal
                                var modal = document.createElement('div');
                                modal.style.position = "fixed";
                                modal.style.top = 0;
                                modal.style.left = 0;
                                modal.style.width = "100%";
                                modal.style.height = "100%";
                                modal.style.backgroundColor = "rgba(0,0,0,0.5)";
                                modal.style.zIndex = 99;
                                document.body.appendChild(modal);

                                //contenido modal
                                var visualizador = document.createElement('div');
                                visualizador.style.position = "fixed";
                                visualizador.style.top = "5%";
                                visualizador.style.left = "25%";
                                visualizador.style.width = "50%";
                                visualizador.style.height = "90%";
                                visualizador.style.backgroundColor = "White";
                                visualizador.style.zIndex = 100;
                                visualizador.appendChild(iframe);
                                document.body.appendChild(visualizador);

                                //cerrar modal
                                var closer = document.createElement('img');
                                closer.style.position = "fixed";
                                closer.style.top = "0";
                                closer.style.right = "0";
                                closer.style.padding = "5px";
                                closer.style.zIndex = 101;
                                closer.style.cursor = "pointer";
                                closer.innerHTML = "X";

                                closer.addEventListener("click", function () {
                                    document.body.removeChild(visualizador);
                                    document.body.removeChild(modal);
                                    document.body.removeChild(this);
                                });

                                document.body.appendChild(closer);

                                // para evitar que si no tiene solicitudes que haga el evento
                                li.addEventListener('click', function () {
                                    if (this.dataset.noEvent) {
                                        return;
                                    }
                                });
                            });
                        })(li);
                    }
                });

                if (solicitudesCount === 0) {
                    var li = document.createElement("li");
                    li.innerHTML = "No hay solicitudes para esta beca";
                    li.dataset.noEvent = 'true';
                    ul.appendChild(li);
                }



                barecontainer.appendChild(bare);
                i++;
            });

        });

});