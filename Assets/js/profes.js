//Per tractar la taula de mostrar professors
let table = new DataTable('#myTable');

let btnCanviarContrasenya = document.getElementById('canviarContrasenya');

if (btnCanviarContrasenya) {
    btnCanviarContrasenya.addEventListener('click', function() {
        window.location.href = '../Controller/canviarContrasenya.php';
    });
}

async function confirmDelete() {
    let conf = confirm('Estas segur que vols eliminar el professor?');
    if (conf) {
        let idProfe = $("#idProfesEliminar").val();
        if (idProfe == "") {
            alert("Els camps no poden estar buits");
            return;
        } else {
            let peticio = {
                accio: "eliminarProfessor",  // Corregido
                idProfesEliminar: idProfe,
            };
            //Enviar peticion en AJAX al php
            console.log(peticio);
            $.ajax({
                url: "./profes.php",
                method: "POST",
                data: peticio,
                dataType: "json",
                success: function(response) {
                    if(response.success){
                        alert("Professor eliminat correctament");
                        location.reload(); // Recargar la página para reflejar el cambio
                    } else {
                        alert(response.message); // Mostrar el mensaje de error
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    let errorMessage = JSON.parse(xhr.responseText).message;
                    alert("Error al eliminar professor. Detall: " + errorMessage);
                }
            });            
        }
    }
}


let btnEliminar = document.getElementById("eliminarProfes");

if (btnEliminar) {
    btnEliminar.addEventListener("click", function() {
        confirmDelete();
    });
}


//Afegir professor
let btnAfegirDialog = document.getElementById("btnAfegirProfe");
let dialogAfegir = document.getElementById("afegirProfesDialog");
let tancarAfegirProfe = document.getElementById("tancarAfegirProfes");

//Modificar professor
let btnModificarDialog = document.getElementById("btnModificarProfe");
let dialogModificar = document.getElementById("modificarProfesDialog");
let tancarModificarProfe = document.getElementById("tancarModificarProfes");

//Eliminar professor
let btnEliminarDialog = document.getElementById("btnEliminarProfe");
let dialogEliminar = document.getElementById("eliminarProfesDialog");
let tancarEliminarProfe = document.getElementById("tancarEliminarProfes");

//Afegir professor
if (btnAfegirDialog) {
    btnAfegirDialog.addEventListener("click", function() {
        //Al abrir el dialog se vaciaran los campos
        $("#nomProfesAfegir").val("");
        $("#cognomProfesAfegir").val("");
        $("#emailProfesAfegir").val("");
        $("#passwordProfesAfegir").val("");
        dialogAfegir.showModal();
    });
}

dialogAfegir.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogAfegir.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogAfegir.close();
});
if (tancarAfegirProfe) {
    tancarAfegirProfe.addEventListener("click", function() {
        dialogAfegir.close();
    });
}

//Modificar professor
if (btnModificarDialog) {
    btnModificarDialog.addEventListener("click", function() {
        //Al abrir el dialog se vaciaran los campos
        $("#idProfesModificar").val("");
        $("#nomProfesModificar").val("");
        $("#cognomProfesModificar").val("");
        $("#emailProfesModificar").val("");
        $("#passwordProfesModificar").val("");
        dialogModificar.showModal();
    });
}

dialogModificar.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogModificar.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogModificar.close();
});
if (tancarModificarProfe) {
    tancarModificarProfe.addEventListener("click", function() {
        dialogModificar.close();
    });
}

//Eliminar professor
if (btnEliminarDialog) {
    btnEliminarDialog.addEventListener("click", function() {
        //Al abrir el dialog se vaciaran los camposç
        $("#idProfesEliminar").val("");
        dialogEliminar.showModal();
    });
}

dialogEliminar.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogEliminar.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogEliminar.close();
});
if (tancarEliminarProfe) {
    tancarEliminarProfe.addEventListener("click", function() {
        dialogEliminar.close();
    });
}