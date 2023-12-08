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


				//le ponemos el evento click para que aparezca la modal
				(function (elemento) {
					elemento.addEventListener("click", function () {
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
						document.body.appendChild(visualizador);

						//contenido modal

						var formulario = document.createElement('form');
						formulario.method = "POST";
						formulario.action = "http://virtual.administracion.com/API/apiCandidato.php";
						formulario.enctype = "multipart/form-data";
						formulario.style.margin = "auto";
						formulario.style.width = "80%";
						formulario.style.height = "80%";
						formulario.style.display = "flex";
						formulario.style.flexDirection = "column";
						formulario.style.justifyContent = "space-around";
						formulario.style.alignItems = "center";
						formulario.style.padding = "20px";
						formulario.style.borderRadius = "10px";

						var titulo = document.createElement('h1');
						titulo.innerHTML = "Formulario de solicitud";
						titulo.style.textAlign = "center";
						titulo.style.width = "100%";
						titulo.style.height = "30px";

						formulario.appendChild(titulo);
						//nombre, apellidos, dni, email, telefono, domicilio, curso, archivos varios
						var nombre = document.createElement('input');
						nombre.type = "text";
						nombre.name = "nombre";
						nombre.id = "nombre";
						nombre.placeholder = "Nombre";
						nombre.style.width = "50%";
						nombre.style.height = "30px";
						nombre.style.borderRadius = "5px";

						var apellidos = document.createElement('input');
						apellidos.type = "text";
						apellidos.name = "apellidos";
						apellidos.id = "apellidos";
						apellidos.placeholder = "Apellidos";
						apellidos.style.width = "50%";
						apellidos.style.height = "30px";
						apellidos.style.borderRadius = "5px";

						var dni = document.createElement('p');
						dni.textContent = "DNI: ";

						var dniSpan = document.createElement('span');
						dniSpan.className = "dniUser";
						dni.appendChild(dniSpan);

						dni.appendChild(document.createTextNode(" perteneces al curso de "));

						var cursoSpan = document.createElement('span');
						cursoSpan.className = "cursoUser";
						dni.appendChild(cursoSpan);


						var email = document.createElement('input');
						email.type = "email";
						email.name = "email";
						email.id = "email";
						email.placeholder = "Email";
						email.style.width = "50%";
						email.style.height = "30px";
						email.style.borderRadius = "5px";

						var telefono = document.createElement('input');
						telefono.type = "text";
						telefono.name = "telefono";
						telefono.id = "telefono";
						telefono.placeholder = "Telefono";
						telefono.style.width = "50%";
						telefono.style.height = "30px";
						telefono.style.borderRadius = "5px";

						var domicilio = document.createElement('input');
						domicilio.type = "text";
						domicilio.name = "domicilio";
						domicilio.id = "domicilio";
						domicilio.placeholder = "Domicilio";
						domicilio.style.width = "50%";
						domicilio.style.height = "30px";
						domicilio.style.borderRadius = "5px";

						var cv = document.createElement('input');
						cv.type = "file";
						cv.name = "cv";
						cv.required = true;
						cv.style.width = "50%";
						cv.style.height = "30px";
						cv.style.borderRadius = "5px";

						//rellenamos datos del usuario en los inputs

						fetch(`http://virtual.administracion.com/API/apiPerfil.php?id=${id}`)
							.then(x => x.json())
							.then(y => {
								if (y.dni !== undefined) {
									dniSpan.innerHTML = y.dni;
								}
								if (y.nombre !== undefined) {
									nombre.value = y.nombre;
								}
								if (y.apellidos !== undefined) {
									apellidos.value = y.apellidos;
								}
								if (y.correo !== undefined) {
									email.value = y.correo;
								}
								if (y.telefono !== undefined) {
									telefono.value = y.telefono;
								}
								if (y.domicilio !== undefined) {
									domicilio.value = y.domicilio;
								}
							});
						
						fetch(`http://virtual.administracion.com/API/apiDestinatario.php?id=${id}`)
						.then(x => x.json())
						.then(y => {
							if (y !== undefined) {
								cursoSpan.innerHTML = y;
							}
						});

						formulario.appendChild(dni);
						formulario.appendChild(nombre);
						formulario.appendChild(apellidos);
						formulario.appendChild(email);
						formulario.appendChild(telefono);
						formulario.appendChild(domicilio);
						formulario.appendChild(cv);

						var boton = document.createElement('input');
						boton.type = "submit";
						boton.value = "Enviar";
						boton.style.width = "50%";
						boton.style.height = "30px";
						boton.style.borderRadius = "5px";

						formulario.appendChild(boton);

						formulario.addEventListener("submit", function (ev) {
							ev.preventDefault();
						});

						visualizador.appendChild(formulario);

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
					});
				})(becas);




				listaBecas.appendChild(becas);
			}
		})
});