window.addEventListener("load", function () {
    const home = document.getElementById("home");
    const perfil = document.getElementById("perf");
    const convocatoria = document.getElementById("conv");
    const baremacion = document.getElementById("bare");
    const configuracion = document.getElementById("conf");
    const logout = document.getElementById("cerrar");

    var url = new URL(window.location.href);

    var id = url.searchParams.get("id");

    home.addEventListener("click", function () {
        document.location = "?menu=home&id=" + id;
    });

    perfil.addEventListener("click", function () {
        document.location = "?menu=perfil&id=" + id;
    });

    convocatoria.addEventListener("click", function () {
        document.location = "?menu=crea&id=" + id;
    });

    baremacion.addEventListener("click", function () {
        document.location = "?menu=bare&id=" + id;
    });

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