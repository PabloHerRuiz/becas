window.addEventListener('load', function() {

    const proyecto = document.getElementById('proyecto');

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



});