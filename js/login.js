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
        // Realiza las validaciones aquí...
        if (form.valida()) {
            form.submit();
        }
    });



    //registro

    const form2 = document.getElementById('formRegistro');
    form2.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita el envío del formulario

        // Realiza las validaciones aquí...
        if (form2.valida()) {
            // Si las validaciones pasan, envía el formulario
            // form2.submit();
        }
    });

})