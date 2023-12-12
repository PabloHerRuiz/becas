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

                                pdf = JSON.parse(solicitud.url);
                                var claves = [];
                                var valores = [];

                                for (var clave in pdf) {
                                    claves.push(clave);
                                    valores.push(pdf[clave]);
                                }

                                var posicionActual = 0;

                                iframe.src = "/pdf/" + encodeURIComponent(valores[posicionActual]);
                                iframe.width = "100%";
                                iframe.height = "100%";

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


                                //flechas
                                var siguiente = document.createElement('img');
                                siguiente.id = "siguiente";
                                siguiente.style.top = "25%";
                                siguiente.style.float = "right";
                                siguiente.style.marginRight = "20px";
                                siguiente.style.marginTop = "23%";
                                siguiente.style.cursor = "pointer";
                                siguiente.style.zIndex = 102;
                                siguiente.src = "/css/imagenes/flechas-a-la-derecha.png";


                                var atras = document.createElement('img');
                                atras.id = "atras";
                                atras.style.top = "25%";
                                atras.style.float = "left";
                                atras.style.marginLeft = "80px";
                                atras.style.marginTop = "23%";
                                atras.style.cursor = "pointer";
                                atras.style.zIndex = 102;
                                atras.src = "/css/imagenes/flecha-izquierda.png";


                                // Solo muestra las flechas si hay más de un PDF
                                if (valores.length >= 1) {
                                    atras.style.display = (posicionActual === 0) ? 'none' : 'block';
                                    siguiente.style.display = (posicionActual === valores.length - 1) ? 'none' : 'block';
                                }

                                //eventos flechas 
                                siguiente.addEventListener("click", function () {
                                    posicionActual++;
                                    if (posicionActual >= valores.length) {
                                        posicionActual = 0;
                                    }
                                    iframe.src = "/pdf/" + encodeURIComponent(valores[posicionActual]);

                                    // Actualiza la visibilidad de las flechas
                                    atras.style.display = (posicionActual === 0) ? 'none' : 'block';
                                    siguiente.style.display = (posicionActual === valores.length - 1) ? 'none' : 'block';
                                });

                                atras.addEventListener("click", function () {
                                    posicionActual--;
                                    if (posicionActual < 0) {
                                        posicionActual = valores.length - 1;
                                    }
                                    iframe.src = "/pdf/" + encodeURIComponent(valores[posicionActual]);

                                    // Actualiza la visibilidad de las flechas
                                    atras.style.display = (posicionActual === 0) ? 'none' : 'block';
                                    siguiente.style.display = (posicionActual === valores.length - 1) ? 'none' : 'block';
                                });

                                //agregar al modal
                                modal.appendChild(siguiente);
                                modal.appendChild(atras);

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
                                closer.src = "/css/imagenes/cerrar.png";

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