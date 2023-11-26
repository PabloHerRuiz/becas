window.addEventListener("load", function () {
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    //login

    const form = document.getElementById('formLogin');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita el envío del formulario

        const nombre = form.elements["username"].value;
        const contra = form.elements["password"].value;

        // Realiza las validaciones aquí...
        if (nombre === '' || contra === '') {
            alert('Por favor, rellena todos los campos.');
        } else {
            // Si las validaciones pasan, envía el formulario
            form.submit();
        }
    });



    //registro

    const form2 = document.getElementById('formRegistro');
    form2.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita el envío del formulario

        const nombre = form2.elements["nombre"].value;
        const apellidos = form2.elements["apellidos"].value;
        const contra = form2.elements["pass"].value;
        const email = form2.elements["correo"].value;

        // Realiza las validaciones aquí...
        if (nombre === '' || contra === '' || apellidos === '' || email === '') {
            alert('Por favor, rellena todos los campos.');
        } else {
            // Si las validaciones pasan, envía el formulario
            form2.submit();
        }
    });

})