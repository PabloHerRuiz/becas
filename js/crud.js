window.addEventListener('load', function () {
    // Obtener referencia al elemento de la tabla
    const table = document.getElementById('convocatorias-table');
    // Obtener los datos de la API utilizando fetch
    fetch('http://virtual.administracion.com/API/apiConvocatoria.php?todas=1')
        .then(response => response.json())
        .then(data => {
            // Rellenar la tabla con los datos obtenidos
            const properties = Object.keys(data[0]);
            const headerRow = table.insertRow();
            properties.forEach(property => {
                const headerCell = headerRow.insertCell();
                headerCell.textContent = property;
            });
            
            data.forEach(convocatoria => {
                const row = table.insertRow();
                properties.forEach(property => {
                    row.insertCell().textContent = convocatoria[property];
                });
                
                // Agregar botones de editar y eliminar
                const editarButton = document.createElement('button');
                editarButton.textContent = 'Editar';
                editarButton.addEventListener('click', () => {
                    // Lógica para editar la convocatoria
                    // ...
                });
                row.insertCell().appendChild(editarButton);
                const eliminarButton = document.createElement('button');
                eliminarButton.textContent = 'Eliminar';
                eliminarButton.addEventListener('click', () => {
                    // Lógica para eliminar la convocatoria
                    // ...
                });
                row.insertCell().appendChild(eliminarButton);
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos de la API:', error);
        });
});