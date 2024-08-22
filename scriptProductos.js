fetch('consultas/buscarPruducto.php')
.then(response => response.json())
.then(nombres => {
    const select = document.getElementById('mi-select');

    // Llenar el select con los nombres
    nombres.forEach(nombre => {
        const option = document.createElement('option');
        option.value = nombre;
        option.textContent = nombre;
        select.appendChild(option);
    });
})
.catch(error => {
    console.error('Error al obtener los nombres de los docentes:', error);
});