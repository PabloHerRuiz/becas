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
	let listaSolicitudes = document.querySelector('#lista-soli');


	//cargo la plantilla de una

	fetch("/vistas/plantillas/listadoBecas.html")
		.then(x => x.text())
		.then(y => {
			plantillaBecas = document.createElement('li');
			plantillaBecas.innerHTML = y;

		})

	//cargamos los datos de la plantilla de solicitud
	fetch("/vistas/plantillas/Solicitud ErasmusCFGM23-24.html")
		.then(x => x.text())
		.then(y => {
			plantillaSolicitud = document.createElement('div');
			plantillaSolicitud.innerHTML = y;
		});

	//cargamos los datos de las becas
	fetch('http://virtual.administracion.com/API/apiConvocatoria.php?id=' + id)
		.then(x => x.json())
		.then(y => {
			for (let i = 0; i < y.length; i++) {
				var becas = plantillaBecas.cloneNode(true);

				becas.setAttribute("data-id", y[i].idConvocatorias);

				var destinos = becas.querySelector(".des");
				var movilidades = becas.querySelector(".mov");
				var tipo = becas.querySelector(".tip");
				var fin = becas.querySelector(".fin");
				var button = becas.querySelector("button");
				var enlace = becas.querySelector("a");

				destinos.innerHTML = y[i].destinos;
				fin.innerHTML = y[i].fecha_fin;
				movilidades.innerHTML = y[i].movilidades;
				button.setAttribute("data-id", y[i].idConvocatorias);
				enlace.setAttribute("data-id", y[i].idConvocatorias);

				if (y[i].tipo == 1) {
					tipo.innerHTML = "Larga Duración";
				} else if (y[i].tipo == 2) {
					tipo.innerHTML = "Corta Duración";
				}

				//mostrar html solicitud
				(function (enlace) {
					enlace.addEventListener("click", function () {
						var idConvocatorias = enlace.dataset.id;
						var soli = plantillaSolicitud.cloneNode(true);

						var spans = soli.getElementsByClassName("s2");
						
						//creamos el iframe
						var iframe = document.createElement('iframe');

						//rellenamos datos del usuario en los span
						iframe.addEventListener("load", function () {
							fetch(`http://virtual.administracion.com/API/apiDestinatario.php?id=${id}`)
								.then(x => x.json())
								.then(y => {
									if (y !== undefined) {
										soli.getElementsByClassName('s3')[1].innerHTML = y;
									}
								});
							fetch(`http://virtual.administracion.com/API/apiProyecto.php?documento=1&idConvocatorias=${idConvocatorias}`)
								.then(x => x.json())
								.then(y => {

									if (y !== undefined) {
										soli.getElementsByClassName('s4')[0].innerHTML = y + " ";
									}
								});

							fetch(`http://virtual.administracion.com/API/apiPerfil.php?id=${id}`)
								.then(x => x.json())
								.then(y => {
									if (y.dni !== undefined) {
										spans[1].innerHTML = y.dni;
									}
									if (y.nombre !== undefined || y.apellidos !== undefined) {
										spans[0].innerHTML = y.nombre + " " + y.apellidos;
									}

									if (y.correo !== undefined) {
										spans[4].innerHTML = y.correo;
									}
									if (y.telefono !== undefined) {
										spans[3].innerHTML = y.telefono;
									}
									if (y.domicilio !== undefined) {
										spans[2].innerHTML = y.domicilio;
									}

									fechaActual = new Date();
									spans[5].innerHTML = fechaActual.getDate() + " ";
									spans[6].innerHTML = (fechaActual.getMonth() + 1) + " ";
									spans[7].innerHTML = fechaActual.getFullYear();

									iframe.contentWindow.document.body.innerHTML = soli.innerHTML;
								});

						});
						iframe.src = "about:blank";


						// iframe.src = soli.innerHTML;
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
					});
				})(enlace);

				//le ponemos el evento click para que aparezca la modal
				(function (button) {
					button.addEventListener("click", function () {
						var idConvocatorias = button.dataset.id;
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
						formulario.action = "http://virtual.administracion.com/API/apiSolicitud.php?idConvocatorias=" + idConvocatorias + "&id=" + id;
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
						var fileContainer = document.createElement('div');
						fileContainer.id = "fileContainer";
						fileContainer.style.marginTop = "12px";
						fileContainer.style.display = "flex";
						fileContainer.style.flexDirection = "column";
						fileContainer.style.marginRight = "110px";

						fetch("http://virtual.administracion.com/API/apiItem.php?idConvocatorias=" + idConvocatorias + "&archivos=1")
							.then(x => x.json())
							.then(y => {
								y.forEach(element => {
									var file = document.createElement('input');
									file.type = "file";
									file.id = element;
									file.name = element;
									file.style.width = "50%";
									file.style.height = "30px";
									file.style.borderRadius = "5px";
									file.style.marginBottom = "10px";

									var label = document.createElement('label');
									label.htmlFor = element;
									label.textContent = element;

									fileContainer.appendChild(label);
									fileContainer.appendChild(file);
								});
							})
							.catch(error => console.error(error));

						var nombre = document.createElement('input');
						nombre.type = "text";
						nombre.name = "nombre";
						nombre.id = "nombre";
						nombre.placeholder = "Nombre";
						nombre.setAttribute("data-valida", "relleno");
						nombre.style.width = "50%";
						nombre.style.height = "30px";
						nombre.style.borderRadius = "5px";

						var apellidos = document.createElement('input');
						apellidos.type = "text";
						apellidos.name = "apellidos";
						apellidos.id = "apellidos";
						apellidos.placeholder = "Apellidos";
						apellidos.setAttribute("data-valida", "relleno");
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
						email.setAttribute("data-valida", "email");
						email.style.width = "50%";
						email.style.height = "30px";
						email.style.borderRadius = "5px";

						var telefono = document.createElement('input');
						telefono.type = "text";
						telefono.name = "telefono";
						telefono.id = "telefono";
						telefono.placeholder = "Telefono";
						telefono.setAttribute("data-valida", "relleno");
						telefono.style.width = "50%";
						telefono.style.height = "30px";
						telefono.style.borderRadius = "5px";

						var domicilio = document.createElement('input');
						domicilio.type = "text";
						domicilio.name = "domicilio";
						domicilio.id = "domicilio";
						domicilio.placeholder = "Domicilio";
						domicilio.setAttribute("data-valida", "relleno");
						domicilio.style.width = "50%";
						domicilio.style.height = "30px";
						domicilio.style.borderRadius = "5px";

						var dniInput = document.createElement('input');
						dniInput.type = 'hidden';
						dniInput.name = 'dni';

						var cursoInput = document.createElement('input');
						cursoInput.type = 'hidden';
						cursoInput.name = 'curso';

						//rellenamos datos del usuario en los inputs

						fetch(`http://virtual.administracion.com/API/apiPerfil.php?id=${id}`)
							.then(x => x.json())
							.then(y => {
								if (y.dni !== undefined) {
									dniSpan.innerHTML = y.dni;
									dniInput.value = y.dni;
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
									cursoInput.value = y;
								}
							});

						formulario.appendChild(dni);
						formulario.appendChild(dniInput);
						formulario.appendChild(nombre);
						formulario.appendChild(apellidos);
						formulario.appendChild(email);
						formulario.appendChild(telefono);
						formulario.appendChild(domicilio);
						formulario.appendChild(cursoInput);
						formulario.appendChild(fileContainer);

						var boton = document.createElement('input');
						boton.type = "submit";
						boton.value = "Enviar";
						boton.style.width = "50%";
						boton.style.height = "30px";
						boton.style.borderRadius = "5px";

						formulario.appendChild(boton);

						//formulario
						formulario.addEventListener("submit", function (ev) {
							ev.preventDefault();
							if (formulario.valida()) {
								formulario.submit();
								alert("Formulario enviado");
							}
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
				})(button);




				listaBecas.appendChild(becas);
			}
			// Después de que todos los elementos <a> hayan sido creados, hacer la comprobación
			var becasElements = document.querySelectorAll('#lista-becas li');

			for (let i = 0; i < becasElements.length; i++) {

				fetch('http://virtual.administracion.com/API/apiSolicitud.php?id=' + id + '&idConvocatorias=' + becasElements[i].getAttribute('data-id') + '&comprobacion=1')
					.then(x => x.json())
					.then(y => {
						if (y === true) {
							// Si el usuario ha enviado una solicitud, añadimos la clase "solicitud-enviada" al elemento
							becasElements[i].querySelector("a").classList.add('solicitud-enviada');
							becasElements[i].querySelector("button").style.display = "none";
						}
					});
			}
		})

	//cargamos los datos de las solicitudes
	fetch('http://virtual.administracion.com/API/apiSolicitud.php?id=' + id)
		.then(x => x.json())
		.then(y => {
			for (let i = 0; i < y.length; i++) {
				var becas = plantillaBecas.cloneNode(true);

				becas.setAttribute("data-id", y[i].idConvocatorias);

				var destinos = becas.querySelector(".des");
				var movilidades = becas.querySelector(".mov");
				var tipo = becas.querySelector(".tip");
				var fin = becas.querySelector(".fin");
				var button = becas.querySelector("button");

				destinos.innerHTML = y[i].destinos;
				fin.innerHTML = y[i].fecha_fin;
				movilidades.innerHTML = y[i].movilidades;
				button.innerHTML = "Actualizar";
				button.setAttribute("data-id", y[i].idConvocatorias);

				if (y[i].tipo == 1) {
					tipo.innerHTML = "Larga Duración";
				} else if (y[i].tipo == 2) {
					tipo.innerHTML = "Corta Duración";
				}

				//mostramos la modal de solicitud
				//le ponemos el evento click para que aparezca la modal
				(function (button) {
					button.addEventListener("click", function () {
						var idConvocatorias = button.dataset.id;
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
						formulario.action = "http://virtual.administracion.com/API/apiSolicitud.php?idConvocatorias=" + idConvocatorias + "&id=" + id + "&actualizar=1";
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
						var fileContainer = document.createElement('fieldSet');
						fileContainer.id = "fileContainer";
						fileContainer.style.marginTop = "12px";
						fileContainer.style.display = "flex";
						fileContainer.style.flexDirection = "column";
						fileContainer.style.width = "50%";
						fileContainer.style.border = "none";

						var legend = document.createElement('legend');
						legend.textContent = "Archivos";
						legend.style.fontWeight = "bold";
						fileContainer.appendChild(legend);

						fetch("http://virtual.administracion.com/API/apiItem.php?idConvocatorias=" + idConvocatorias + "&archivos=1")
							.then(x => x.json())
							.then(y => {
								y.forEach(element => {
									var file = document.createElement('input');
									file.type = "file";
									file.id = element;
									file.name = element;
									file.style.width = "100%";
									file.style.height = "30px";
									file.style.borderRadius = "5px";
									file.style.marginBottom = "10px";

									var label = document.createElement('label');
									label.htmlFor = element;
									label.textContent = element;
									label.style.marginTop = "10px";

									fileContainer.appendChild(label);
									fileContainer.appendChild(file);
								});
							})
							.catch(error => console.error(error));

						var nombre = document.createElement('input');
						nombre.type = "text";
						nombre.name = "nombre";
						nombre.id = "nombre";
						nombre.placeholder = "Nombre";
						nombre.setAttribute("data-valida", "relleno");
						nombre.style.width = "50%";
						nombre.style.height = "30px";
						nombre.style.borderRadius = "5px";

						var apellidos = document.createElement('input');
						apellidos.type = "text";
						apellidos.name = "apellidos";
						apellidos.id = "apellidos";
						apellidos.placeholder = "Apellidos";
						apellidos.setAttribute("data-valida", "relleno");
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
						email.setAttribute("data-valida", "email");
						email.style.width = "50%";
						email.style.height = "30px";
						email.style.borderRadius = "5px";

						var telefono = document.createElement('input');
						telefono.type = "text";
						telefono.name = "telefono";
						telefono.id = "telefono";
						telefono.placeholder = "Telefono";
						telefono.setAttribute("data-valida", "relleno");
						telefono.style.width = "50%";
						telefono.style.height = "30px";
						telefono.style.borderRadius = "5px";

						var domicilio = document.createElement('input');
						domicilio.type = "text";
						domicilio.name = "domicilio";
						domicilio.id = "domicilio";
						domicilio.placeholder = "Domicilio";
						domicilio.setAttribute("data-valida", "relleno");
						domicilio.style.width = "50%";
						domicilio.style.height = "30px";
						domicilio.style.borderRadius = "5px";

						var dniInput = document.createElement('input');
						dniInput.type = 'hidden';
						dniInput.name = 'dni';

						var cursoInput = document.createElement('input');
						cursoInput.type = 'hidden';
						cursoInput.name = 'curso';

						//rellenamos datos del usuario en los inputs

						fetch(`http://virtual.administracion.com/API/apiSolicitud.php?id=${id}` + '&idConvocatorias=' + idConvocatorias + '&proceso=1')
							.then(x => x.json())
							.then(y => {
								if (y.dni !== undefined) {
									dniSpan.innerHTML = y.dni;
									dniInput.value = y.dni;
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
									cursoInput.value = y;
								}
							});

						formulario.appendChild(dni);
						formulario.appendChild(dniInput);
						formulario.appendChild(nombre);
						formulario.appendChild(apellidos);
						formulario.appendChild(email);
						formulario.appendChild(telefono);
						formulario.appendChild(domicilio);
						formulario.appendChild(cursoInput);
						formulario.appendChild(fileContainer);

						var boton = document.createElement('input');
						boton.type = "submit";
						boton.value = "Enviar";
						boton.style.width = "50%";
						boton.style.height = "30px";
						boton.style.borderRadius = "5px";

						formulario.appendChild(boton);

						//formulario
						formulario.addEventListener("submit", function (ev) {
							ev.preventDefault();
							if (formulario.valida()) {
								formulario.submit();
								alert("Formulario actualizado");
							}
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
				})(button);



				listaSolicitudes.appendChild(becas);
			}
		});
});