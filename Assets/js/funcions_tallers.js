$(document).ready(function() {
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
            refrescarMainMapMarkers(); 
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
