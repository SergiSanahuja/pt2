function actualizarTablaDeTalleres() {
    $.ajax({
        url: '../Controller/getMarkers.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var tablaHtml = "";
            data.forEach(function(taller, index) {
                tablaHtml += "<tr>";
                tablaHtml += "<td>" + (index + 1) + "</td>"; // Asumiendo que quieres un contador en lugar del ID real
                tablaHtml += "<td>" + taller.nom + "</td>";
                tablaHtml += "<td>" + taller.material + "</td>";
                tablaHtml += "<td>" + taller.professor + "</td>";
                tablaHtml += `<td><button class="btn btn-primary btn-editar" data-id="${taller.id}">Editar</button>
                <button class="btn btn-danger btn-eliminar" data-id="${taller.id}">Eliminar</button></td>`;
                
                tablaHtml += "</tr>";
            });
            $('#talleresTable tbody').html(tablaHtml);
            
            // Agrega el evento click a cada botón de edición
            $('.btn-editar').on('click', function() {
                let tallerId = $(this).data('id');
                abrirModalEdicion(tallerId);
            });
            $('.btn-eliminar').on('click', function() {
                let tallerId = $(this).data('id');
                eliminarTaller(tallerId);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los talleres: ", status, error);
        }
    });
}

function abrirModalEdicion(tallerId) {
    // Realizar una solicitud AJAX para obtener los datos del taller por ID
    $.ajax({
        url: '../Controller/getTallerById.php',
        type: 'POST',
        data: { id: tallerId },
        dataType: 'json',
        success: function(data) {
            if(data && data.taller) {
                // Rellenar el formulario de edición con los datos del taller
                $('#editarNom').val(data.taller.nom);
                $('#editarProfessor').val(data.taller.professor);
                $('#editarMaterial').val(data.taller.material);
                $('#editarLat').val(data.taller.lat);
                $('#editarLng').val(data.taller.lng);
                $('#editarId').val(data.taller.id);
                $('#modalEditarTaller').modal('show');
            } else {
                alert('No se encontraron datos para el taller con ID: ' + tallerId);
            }
        },
        error: function(xhr, status, error) {
            alert('Ocurrió un error al obtener los datos del taller: ' + error);
        }
    });
}
function eliminarTaller(tallerId) {
    if (confirm('¿Estás seguro de que deseas eliminar este taller?')) {
        $.ajax({
            url: '../Controller/eliminarTaller.php',
            type: 'POST',
            data: { id: tallerId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Taller eliminado con éxito');
                    actualizarTablaDeTalleres();
                } else {
                    alert('Error al eliminar el taller: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                alert('Ocurrió un error al eliminar el taller: ' + error);
            }
        });
    }
}

$(document).ready(function() {
    actualizarTablaDeTalleres();

    $('#afegirTaller').click(function(e) {
        e.preventDefault();
        let formData = new FormData($('#form')[0]);
        formData.append('lat', $('#modalLat').val());
        formData.append('lng', $('#modalLng').val());

        $.ajax({
            url: '../Controller/afegirTaller.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json'
        })
        .done(function(response) {
            if (response.success) {
                alert('Taller agregado con éxito');
                $('#modalTaller').modal('hide');
                $('#form')[0].reset();
                actualizarTablaDeTalleres();
                refrescarMainMapMarkers();
                // nuevoModalMarkers = []; // Asegúrate de que esta variable se declara o se utiliza correctamente
            } else {
                alert('Error al agregar el taller: ' + response.error);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la petición: ', textStatus, errorThrown);
            alert('Ocurrió un error al agregar el taller.');
        });
    });

    $('#modalTaller').on('hidden.bs.modal', function () {
        $('#formState').val('new');
        $('#editingTallerId').val('');
    });
    // Evento para manejar la actualización de un taller existente
    $('#actualizarCambiosTaller').click(function() {
        let formData = new FormData($('#formEditar')[0]);
        formData.append('id', $('#editarId').val());

        $.ajax({
            url: '../Controller/editarTaller.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json'
        })
        .done(function(response) {
            if(response.success) {
                alert('Taller actualizado con éxito');
                $('#modalEditarTaller').modal('hide');
                actualizarTablaDeTalleres();
                refrescarMainMapMarkers();
            } else {
                alert('Error al editar el taller: ' + response.error);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            alert('Error al realizar la solicitud: ' + textStatus);
        });
    });
});
