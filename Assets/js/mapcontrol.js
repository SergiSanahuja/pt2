let api = "https://analisi.transparenciacatalunya.cat/resource/tasf-thgu.json";
let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY";
var markers = [];

window.onload = function() {
    $.getScript("https://maps.googleapis.com/maps/api/js?key=" + googleApiKey + "&callback=initMap");
    window.initMap = initMap;
    
    document.getElementById('btnMapa').addEventListener('click', marcarMarcador);
}

var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('mapa'), {
        center: {
            lat: 41.678620,
            lng: 2.780853
        },
        zoom: 18,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });
}

function marcarMarcador() {
    map.addListener('click', function(event) {
        var marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });
        markers.push(marker);
    });
}
