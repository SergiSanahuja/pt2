

$(document).ready(function(){
    $('#afegirTaller').click(function(e){
      e.preventDefault();
      let formData = new FormData($('#form')[0]);
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
