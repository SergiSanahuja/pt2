let api = "https://analisi.transparenciacatalunya.cat/resource/tasf-thgu.json";
let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY";
let markers = [];
let modifyingMarker = false;

window.onload = function() {
    $.getScript("https://maps.googleapis.com/maps/api/js?key=" + googleApiKey + "&callback=initMap");
    window.initMap = initMap;
}

let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('mapa'), {
        center: {
            lat: 41.67857183725525,
            lng: 2.7803433802871513
        },
        zoom: 19,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });
    
    map.addListener('click', function(event) {
        let marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });
        markers.push(marker);

        // Agrega un evento de clic al marcador
        marker.addListener('click', function() {
            // Si hay un marcador seleccionado, restablece su icono
            if (selectedMarker) {
                selectedMarker.setIcon(null);
            }

            // Cambia el icono del marcador seleccionado
            marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');

            // Actualiza el marcador seleccionado
            selectedMarker = marker;

            if (modifyingMarker) {
                // Pide al usuario que ingrese un nuevo tooltip para el marcador
                let newTooltip = prompt("Por favor, ingresa un nuevo tooltip para el marcador:");
                if (newTooltip !== null) {
                    // Si el usuario ingresó un tooltip, actualiza el tooltip del marcador
                    marker.setTitle(newTooltip);
                }
                modifyingMarker = false;
            }
        });
    });
}

let selectedMarker = null;

function eliminarMarcador() {
    if (markers.length === 0) {
        // Muestra una alerta si no hay marcadores en el mapa
        alert("No hay marcadores para eliminar.");
    } else if (selectedMarker) {
        // Elimina el marcador seleccionado del mapa
        selectedMarker.setMap(null);

        // Elimina el marcador seleccionado del array
        const index = markers.indexOf(selectedMarker);
        if (index > -1) {
            markers.splice(index, 1);
        }

        // Resetea el marcador seleccionado
        selectedMarker = null;
    } else {
        // Muestra una alerta si no hay ningún marcador seleccionado
        alert("Por favor, selecciona un marcador para eliminar.");
    }
}

function eliminarTodosMarcadores() {
    if (markers.length === 0) {
        // Muestra una alerta si no hay marcadores en el mapa
        alert("No hay marcadores para eliminar.");
    } else {
        // Muestra un cuadro de diálogo de confirmación
        let confirmar = confirm("¿Estás seguro de que quieres eliminar todos los marcadores?");
        if (confirmar) {
            // Si el usuario hace clic en Aceptar, elimina todos los marcadores
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }
    }
}

function modificarMarcador() {
    if (markers.length === 0) {
        // Muestra una alerta si no hay marcadores en el mapa
        alert("No hay marcadores para modificar.");
    } else {
        if (selectedMarker) {
            // Si ya hay un marcador seleccionado, pide al usuario que ingrese un nuevo tooltip
            let nuevoToolTip = prompt("Por favor, ingresa un nuevo tooltip para el marcador:");
            if (nuevoToolTip !== null) {
                // Si el usuario ingresó un tooltip, actualiza el tooltip del marcador
                selectedMarker.setTitle(nuevoToolTip);
            }
        } else {
            // Si no hay un marcador seleccionado, activa el modo de modificación
            modifyingMarker = true;
            alert("Por favor, selecciona un marcador para modificar.");
        }
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('btnMapaEliminarMarcador').addEventListener('click', eliminarMarcador);
    document.getElementById('btnMapaEliminarTodosMarcadores').addEventListener('click', eliminarTodosMarcadores);
    document.getElementById('btnMapaModificarMarcador').addEventListener('click', modificarMarcador);
});

