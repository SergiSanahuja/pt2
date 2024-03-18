
let api = "https://analisi.transparenciacatalunya.cat/resource/tasf-thgu.json";
let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY";
let modalMap;
let modalMarkers = [];

window.initModalMap = function() {
    modalMap = new google.maps.Map(document.getElementById('modalMap'), {
        center: { lat: 41.67857183725525, lng: 2.7803433802871513 },
        zoom: 19,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });
    loadModalExistingMarkers();

    modalMap.addListener('click', function(event) {
        clearModalMarkers();
        let marker = new google.maps.Marker({
            position: event.latLng,
            map: modalMap
        });

        document.getElementById('modalLat').value = event.latLng.lat(); 
        document.getElementById('modalLng').value = event.latLng.lng();

        modalMarkers.push(marker);
    });
};

$('#modalTaller').on('shown.bs.modal', function() {
    if (typeof google === 'object' && typeof google.maps === 'object') {
        window.initModalMap();
    } else {
        let script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key=" + googleApiKey + "&callback=initModalMap";
        script.async = true; // Cargar de manera asíncrona
        script.defer = true; // Diferir hasta que el HTML esté parseado
        document.head.appendChild(script);
    }
});

function loadModalExistingMarkers() {
    // Implementar la carga de marcadores existentes
}

function clearModalMarkers() {
    // Eliminar todos los marcadores actuales del mapa
    modalMarkers.forEach(function(marker) {
        marker.setMap(null);
    });
    modalMarkers = [];
}
