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

let btnAfegirDialog = document.getElementById("btnAfegirMatDialog");
let dialogAfegir = document.getElementById("afegirMaterialDialog");
let tancarAfegirMat = document.getElementById("tancarAfegirMat");

let btnModificarDialog = document.getElementById("btnModificarMatDialog");
let dialogModificar = document.getElementById("modificarMaterialDialog");
let tancarModificarMat = document.getElementById("tancarModificarMat");

//Afegir material
if (btnAfegirDialog) {
    btnAfegirDialog.addEventListener("click", function() {
        //Al abrir el dialog se vaciaran los campos
        $("#nomMaterialAfegir").val("");
        $("#quantitatMaterialAfegir").val(1);
        $("#pagatAfegirMat").prop("checked", false);
        dialogAfegir.showModal();
    });
}

dialogAfegir.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogAfegir.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogAfegir.close();
});
if (tancarAfegirMat) {
    tancarAfegirMat.addEventListener("click", function() {
        dialogAfegir.close();
    });
}

//Modificar material
if (btnModificarDialog) {
    btnModificarDialog.addEventListener("click", function() {
        //Al abrir el dialog se vaciaran los campos
        $("#nomMaterialModificar").val("");
        $("#quantitatMaterialModificar").val(0);
        $("#pagatModificarMat").prop("checked", false);
        dialogModificar.showModal();
    });
}

dialogModificar.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogModificar.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogModificar.close();
});
if (tancarModificarMat) {
    tancarModificarMat.addEventListener("click", function() {
        dialogModificar.close();
    });
}

//Cuando el usuario añada una imagen, se mostrara un aviso de que se ha añadido correctamente mientras sea un archivo .png, .jpg o .svg
let inputImatgeAfegir = document.getElementById("arxiuUsuariAfegir");
let inputImatgeModificar = document.getElementById("arxiuUsuariModificar");

if (inputImatgeAfegir) {
    inputImatgeAfegir.addEventListener("change", function() {
        let file = inputImatgeAfegir.files[0];
        let fileName = file.name;
        let fileExtension = fileName.split('.').pop().toLowerCase();
        if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'svg') {
            alert("Imatge afegida correctament");
        } else {
            alert("Només s'accepten fitxers .png, .jpg i .svg");
        }
    });
}

if (inputImatgeModificar) {
    inputImatgeModificar.addEventListener("change", function() {
        let file = inputImatgeModificar.files[0];
        let fileName = file.name;
        let fileExtension = fileName.split('.').pop().toLowerCase();
        if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'svg') {
            alert("Imatge afegida correctament");
        } else {
            alert("Només s'accepten fitxers .png, .jpg i .svg");
        }
    });
}