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




    //cargamos los datos de las bare
    fetch('http://virtual.administracion.com/API/apiConvocatoria.php?baremacion=1')
        .then(x => x.json())
        .then(y => {
            for (let i = 0; i < y.length; i++) {
                (function (i) { 
                    var bare = plantillaBare.cloneNode(true);

                    bare.setAttribute("data-id", y[i].idConvocatorias);

                    var destinos = bare.querySelector(".des");
                    var movilidades = bare.querySelector(".mov");
                    var tipo = bare.querySelector(".tip");
                    var input = bare.querySelector("input");
                    var h2 = bare.querySelector("h2");

                    h2.addEventListener("click", function () {
                        let checkbox = document.getElementById('despliega' + i);
                        checkbox.checked = !checkbox.checked;
                    });


                    destinos.innerHTML = y[i].destinos;
                    input.id = "despliega" + i;
                    movilidades.innerHTML = y[i].movilidades;

                    if (y[i].tipo == 1) {
                        tipo.innerHTML = "Larga Duración";
                    } else if (y[i].tipo == 2) {
                        tipo.innerHTML = "Corta Duración";
                    }
                    fetch('http://virtual.administracion.com/API/apiSolicitud.php?idConvocatorias=' + y[i].idConvocatorias + '&baremacion=1')
                        .then(w => w.json())
                        .then(z => {
                            var ul = bare.querySelector("ul");
                            ul.id = "ul" + i;
                            if (z.length === 0) {
                                var li = document.createElement("li");
                                li.innerHTML = "No hay solicitudes para esta beca";
                                ul.appendChild(li);
                            } else {
                                for (let j = 0; j < z.length; j++) {
                                    var li = document.createElement("li");
                                    li.innerHTML = z[j].nombre + " " + z[j].apellidos;
                                    li.id = z[j].idCandidato;
                                    ul.appendChild(li);
                                }
                            }
                            barecontainer.appendChild(bare);
                        });
                })(i); 
            }

        });

});