window.addEventListener("load", function () {

    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");
    const correo = document.getElementById("correo");
    const telefono = document.getElementById("telefono");
    const curso = document.getElementById("curso");
    const domicilio = document.getElementById("domicilio");
    const fecha_nacimiento = document.getElementById("fecha_nacimiento");

    const form = document.getElementById("formPerfil");

    var url = new URL(window.location.href);

    var id = url.searchParams.get("id");

    fetch(`http://virtual.administracion.com/API/apiPerfil.php?id=${id}`)
        .then(x => x.json())
        .then(y => {
            if (y.dni !== undefined) {
                dni.innerHTML = y.dni;
            }
            if (y.nombre !== undefined) {
                nombre.value = y.nombre;
            }
            if (y.apellidos !== undefined) {
                apellidos.value = y.apellidos;
            }
            if (y.correo !== undefined) {
                correo.value = y.correo;
            }
            if (y.telefono !== undefined) {
                telefono.value = y.telefono;
            }
            if (y.curso !== undefined) {
                curso.value = y.curso;
            }
            if (y.domicilio !== undefined) {
                domicilio.value = y.domicilio;
            }
            if (y.fecha_nacimiento !== undefined && y.fecha_nacimiento !== null) {
                let fecha = new Date(y.fecha_nacimiento);
                fecha_nacimiento.value = fecha.toISOString().slice(0, 10);
            }
        });

    form.addEventListener("submit", function (ev) {
        ev.preventDefault();
        if (form.valida()) {
            fetch(`http://virtual.administracion.com/API/apiPerfil.php?id=${id}`, {
                method: "PUT",
                body: JSON.stringify(Object.fromEntries(new FormData(form).entries())),
                headers: {
                    "Content-Type": "application/json"
                }
            })
                .then(x => {
                    if (x.status == 200 || x.status == 304) {
                        alert("Datos actualizados correctamente");
                    } else {
                        alert("Error al actualizar los datos");
                    }
                })
        }
    })


})