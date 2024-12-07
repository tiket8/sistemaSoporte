// Inicializa los select2 en el formulario (si usas esta librería para selects)
$(document).ready(function () {
    $('.select2').select2();

    // Llenar categorías al cargar la página
    fetchCategories();

    // Manejar el envío del formulario
    $('#ticket_form').on('submit', function (e) {
        e.preventDefault(); // Prevenir el envío del formulario estándar

        // Serializar los datos del formulario
        let formData = new FormData(this);

        // Enviar solicitud al backend con Axios
        axios.post('/tickets', formData)
            .then(response => {
                // Mostrar mensaje de éxito
                Swal.fire('Éxito', 'Ticket creado correctamente.', 'success');
                
                // Redirigir a la lista de tickets
                window.location.href = '/tickets';
            })
            .catch(error => {
                // Manejar errores
                console.error(error);
                Swal.fire('Error', 'Hubo un problema al crear el ticket.', 'error');
            });
    });
});

// Función para obtener categorías desde el backend
function fetchCategories() {
    axios.get('/api/categories')
        .then(response => {
            // Rellena el select de categorías
            let categories = response.data;
            let categorySelect = $('#cat_id');

            categories.forEach(category => {
                categorySelect.append(`<option value="${category.id}">${category.nombre}</option>`);
            });
        })
        .catch(error => {
            console.error('Error al obtener las categorías:', error);
        });
}
