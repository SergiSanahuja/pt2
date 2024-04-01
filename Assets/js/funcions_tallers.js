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
              tablaHtml += "</tr>";
          });
          $('#talleresTable tbody').html(tablaHtml);
      },
      error: function(xhr, status, error) {
          console.error("Error al cargar los talleres: ", status, error);
      }
  });
}

// Lógica para manejar el evento de clic del botón de agregar taller
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
          dataType: 'json' // Esperar respuesta en formato JSON
      })
      .done(function(response) {
          if (response.success) {
              alert('Taller agregado con éxito');
              $('#modalTaller').modal('hide');
              $('#form')[0].reset();
              actualizarTablaDeTalleres();
              // Asegúrate de tener una función que refresque los marcadores en el mapa principal
              refrescarMainMapMarkers(); 
              nuevoModalMarkers = [];
          } else {
              alert('Error al agregar el taller: ' + response.error);
          }
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
          console.error('Error en la petición: ', textStatus, errorThrown);
          alert('Ocurrió un error al agregar el taller.');
      });
  });
});