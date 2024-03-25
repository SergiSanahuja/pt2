let googleModalApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY"; // Tu clave API real
let modalMap;
let modalMarkers = [];

// Esta función inicializa el mapa dentro del modal
function initModalMap() {
    modalMap = new google.maps.Map(document.getElementById('modalMap'), {
        center: { lat: 41.67857183725525, lng: 2.7803433802871513 },
        zoom: 19,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });

    // Listener para cuando se hace clic en el mapa y se agrega un nuevo marcador
    modalMap.addListener('click', function(event) {
        clearModalMarkers();
        createMarker(event.latLng);
    });

    loadModalExistingMarkers();
}

// Crea un marcador y lo añade al array modalMarkers
function createMarker(location) {
    let marker = new google.maps.Marker({
        position: location,
        map: modalMap
    });

    document.getElementById('modalLat').value = location.lat();
    document.getElementById('modalLng').value = location.lng();

    modalMarkers.push(marker);
}

// Carga los marcadores existentes llamando a tu backend PHP
function loadModalExistingMarkers() {
    $.ajax({
        url: '../../Controller/getMarkers.php', // Asegúrate de que esta ruta es accesible y correcta
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            data.forEach(function(taller) {
                let location = new google.maps.LatLng(parseFloat(taller.lat), parseFloat(taller.lng));
                createMarker(location);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los marcadores: ", status, error);
        }
    });
}

// Elimina todos los marcadores del mapa modal
function clearModalMarkers() {
    modalMarkers.forEach(function(marker) {
        marker.setMap(null);
    });
    modalMarkers = [];
}

// Verifica si la API de Google Maps ya está cargada antes de intentar cargarla nuevamente
if (typeof google !== 'object' || typeof google.maps !== 'object') {
    $.getScript(`https://maps.googleapis.com/maps/api/js?key=${googleModalApiKey}&callback=initModalMap`)
        .fail(function(jqxhr, settings, exception) {
            console.error("Error loading Google Maps script: ", exception);
        });
}

// Evento que se dispara cuando se muestra el modal
$('#modalTaller').on('shown.bs.modal', function() {
    if (typeof google === 'object' && typeof google.maps === 'object') {
        google.maps.event.trigger(modalMap, 'resize'); // Trigger resize event to ensure map is displayed correctly
    }
    });
    
    // Evento que se dispara cuando se oculta el modal
    $('#modalTaller').on('hidden.bs.modal', function() {
    // Opcional: limpia los marcadores si no deseas mantenerlos entre sesiones del modal
    clearModalMarkers();
    });
