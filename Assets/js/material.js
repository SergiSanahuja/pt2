async function confirmDelete() {
    let conf = confirm('Estas segur que vols eliminar el material?');
    if (conf) {
        let nomMat = $("#nomMaterial").val();
        let quantMat = $("#quantMaterial").val();
        if (nomMat == "" || quantMat < 0) {
            alert("Els camps no poden estar buits");
            return;
        }
        let peticio = {
            accio: "eliminarMaterial",
            nom: nomMat,
            quantitat: quantMat
        };



        //Enviar peticion en AJAX al php
        $.ajax({
            url: "./material.php",
            method: "POST",
            data: JSON.stringify(peticio),
            success: function(response) {
                alert("Material eliminat correctament");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Error al inseri usuari.");
            }
        });
    }
}

let btnEliminar = document.getElementById("eliminarMaterial");

if (btnEliminar) {
    btnEliminar.addEventListener("click", function() {
        confirmDelete();
    });
}
