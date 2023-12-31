window.addEventListener("load", function () {
    const home = document.getElementById("home");
    const perfil = document.getElementById("perf");
    const convocatoria = document.getElementById("conv");
    const baremacion = document.getElementById("bare");
    const crud = document.getElementById("crud");
    const configuracion = document.getElementById("conf");
    const logout = document.getElementById("cerrar");

    var url = new URL(window.location.href);
    var rol = url.searchParams.get("rol");
    var id = url.searchParams.get("id");

    //en funcion del rol se muestran unos botones u otros
    if (rol !== "admin") {
        convocatoria.style.display = "none";
        baremacion.style.display = "none";
        crud.style.display = "none";
    }

    //en funcion del rol manda mas o menos parametros
    home.addEventListener("click", function () {
        if (rol == "admin") {
            document.location = "?menu=home&id=" + id + "&rol=" + rol;
        } else {
            document.location = "?menu=home&id=" + id;
        }
    });
    //en funcion del rol manda mas o menos parametros
    perfil.addEventListener("click", function () {
        if (rol == "admin") {
            document.location = "?menu=perfil&id=" + id + "&rol=" + rol;
        } else {
            document.location = "?menu=perfil&id=" + id;
        }
    });

    //manda a la pagina de que sea
    convocatoria.addEventListener("click", function () {
        document.location = "?menu=crea&id=" + id + "&rol=" + rol;
    });

    baremacion.addEventListener("click", function () {
        document.location = "?menu=bare&id=" + id + "&rol=" + rol;
    });

    crud.addEventListener("click", function () {
        document.location = "?menu=crud&id=" + id + "&rol=" + rol;
    });


    //cierra sesion
    logout.addEventListener("click", function () {
        fetch("http://virtual.administracion.com/API/apiSesion.php")
            .then(x => {
                if (x.status == 200) {
                    document.location = "?menu=login";
                } else if (x.status == 500) {
                    alert("Error al cerrar sesión");
                }
            })

    });
});