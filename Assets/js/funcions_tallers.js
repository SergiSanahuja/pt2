$(document).ready(function(){
  $('#afegirTaller').click(function(e){
    e.preventDefault();
    let formData = new FormData($('#form')[0]);

    // Agrega la latitud y longitud del marcador al objeto FormData
    let lat = parseFloat($('#modalLat').val());
    let lng = parseFloat($('#modalLng').val());

    if (isNaN(lat) || isNaN(lng)) {
        alert('Latitud o longitud no válidas: ' + lat + ', ' + lng);
        return;
    }

    formData.append('lat', lat);
    formData.append('lng', lng);

    $.ajax({
      url: '../Controller/afegirTaller.php',
      type: 'POST',
      data: formData,
      success: function(data){
        let response = JSON.parse(data);
        if(response.success){
          alert('Taller agregado con éxito');
          $('#modalTaller').modal('hide');
        } else {
          alert('Error al agregar el taller: ' + response.error);
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });
  });
});