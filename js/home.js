function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

window.addEventListener('load', function () {
  // Obtenemos el elemento con id="defaultOpen" y lo pulsamos
  document.getElementById("defaultOpen").click();

  var url = new URL(window.location.href);

  var id = url.searchParams.get("id");

  let becasDispo = document.getElementById('contenedor-dispo');
  let listaBecas = document.querySelector('#lista-becas');

  //cargo la plantilla de una

  fetch("/vistas/plantillas/listadoBecas.html")
    .then(x => x.text())
    .then(y => {
      plantillaBecas = document.createElement('li');
      plantillaBecas.innerHTML = y;

    })

  //cargamos los datos de las becas
  fetch('http://virtual.administracion.com/API/apiConvocatoria.php?id=' + id)
    .then(x => x.json())
    .then(y => {
      console.log(y);
      for (let i = 0; i < y.length; i++) {
        var becas = plantillaBecas.cloneNode(true);

        var destinos = becas.querySelector(".des");
        var movilidades = becas.querySelector(".mov");
        var tipo = becas.querySelector(".tip");

        destinos.innerHTML = y[i].destinos;

        movilidades.innerHTML = y[i].movilidades;

        if (y[i].tipo == 1) {
          tipo.innerHTML = "Larga Duración";
        } else if (y[i].tipo == 2) {
          tipo.innerHTML = "Corta Duración";
        }
        listaBecas.appendChild(becas);
      }
    })
});