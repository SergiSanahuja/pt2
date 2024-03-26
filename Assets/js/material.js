async function confirmDelete() {
    let conf = confirm('Estas segur que vols eliminar el material?');
    if (conf) {
        let nomMat = $("#nomMaterialEliminar").val();
        if (nomMat == "") {
            alert("Els camps no poden estar buits");
            return;
        } else {
            let peticio = {
                accio: "eliminarMaterial",
                nomMaterialEliminar: nomMat,
            };
            //Enviar peticion en AJAX al php
            console.log(peticio);
            $.ajax({
                url: "./material.php",
                method: "POST",
                data: peticio,
                success: function(response) {
                    if(response.success){
                        alert("Material eliminat correctament");
                    } else {
                        alert(response); // Mostrar el mensaje directamente
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error al eliminar material. Detall: " + xhr.responseText);
                }
            });
        }
    }
}

let btnEliminar = document.getElementById("eliminarMaterial");

if (btnEliminar) {
    btnEliminar.addEventListener("click", function() {
        confirmDelete();
    });
}

//Afegir material
let btnAfegirDialog = document.getElementById("btnAfegirMatDialog");
let dialogAfegir = document.getElementById("afegirMaterialDialog");
let tancarAfegirMat = document.getElementById("tancarAfegirMat");

//Modificar material
let btnModificarDialog = document.getElementById("btnModificarMatDialog");
let dialogModificar = document.getElementById("modificarMaterialDialog");
let tancarModificarMat = document.getElementById("tancarModificarMat");

//Eliminar material
let btnEliminarDialog = document.getElementById("btnEliminarMatDialog");
let dialogEliminar = document.getElementById("eliminarMaterialDialog");
let tancarEliminarMat = document.getElementById("tancarEliminarMat");

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

//Eliminar material
if (btnEliminarDialog) {
    btnEliminarDialog.addEventListener("click", function() {
        dialogEliminar.showModal();
    });
}

dialogEliminar.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = dialogEliminar.getBoundingClientRect();

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) dialogEliminar.close();
});
if (tancarEliminarMat) {
    tancarEliminarMat.addEventListener("click", function() {
        dialogEliminar.close();
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