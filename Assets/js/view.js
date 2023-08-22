//iniciamos la herramienta de busqueda
let geocoder = new google.maps.Geocoder()
const polygon = $('#polygon').text()
const convert = polygon.split(',')

function createMarker(position, map) {
    //inicia el marcador
    let marker = new google.maps.Marker({
        //posicion
        position: position,
        //mapa al que se carga
        map: map,
    })
    //colocamos el marker en el mapa
    marker.setMap(map)
}

function createCircle(position, radio, map) {
    //iniciar una circunferencia
    let circle = new google.maps.Circle({
        //configuracion
        strokeColor: "#048FE4",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#048FE4",
        fillOpacity: 0.35,
        //mapa donde se carga
        center: position,
        //radio
        radius: radio,
        //propiedad de editable
        editable: false,
    })
    circle.setMap(map)
}

function createRectangle(position, array, map) {
    let rectangle = new google.maps.Rectangle({
        strokeColor: "#048FE4",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#048FE4",
        fillOpacity: 0.35,
        center: position,
        bounds: {
            north: parseFloat(array[1]),
            south: parseFloat(array[3]),
            east: parseFloat(array[4]),
            west: parseFloat(array[2]),
        },
        editable: false
    })
    rectangle.setMap(map)
}

function createPolygon(position, array, map) {
    let path = []
    for (let i = 1, j = 0; i < array.length; i++, j++) {
        if (array[i + j] == undefined) { break }
        path.push({ lat: parseFloat(array[i + j]), lng: parseFloat(array[i + j + 1]) })
    }
    // Construct the polygon.
    let polygon = new google.maps.Polygon({
        paths: path,
        strokeColor: "#048FE4",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#048FE4",
        fillOpacity: 0.35,
        center: position,
        editable: false
    });
    polygon.setMap(map)
}

//funcion para buscar direcciones
function geocode(request) {
    geocoder
        .geocode(request)
        .then((result) => {
            const { results } = result
            //asignamos el centro del mapa
            map.setCenter(results[0].geometry.location)
            //inicia el marcador
            createMarker(results[0].geometry.location, map)
            let figure = ''
            if (convert[0] == 'circle') {
                createCircle(results[0].geometry.location, parseFloat(convert[convert.length - 1]), map)
            } else if (convert[0] == 'rectangle') {
                createRectangle(results[0].geometry.location, convert, map)
            } else {
                createPolygon(results[0].geometry.location, convert, map)
            }
        })
        .catch((e) => {
            alert("Geocode was not successful for the following reason: " + e)
        })
}
//inicia el mapa y define la configuracion del mapa
let map = new google.maps.Map(document.getElementById("map"), {
    //zoom del mapa
    zoom: 16,
    //zoom maximo
    maxZoom: 18,
    //centro del mapa
    center: {
        lat: 39.02007335494998,
        lng: -76.97469811827334
    },
    //desactiva ui
    disableDefaultUI: true,
    //
    gestureHandling: "none",
    //controles de zoom
    zoomControl: true,
    //configuracion del control
    zoomControlOptions: {
        //posicion dentro del mapa
        position: google.maps.ControlPosition.LEFT_BOTTOM,
    },
    //tipo de mapa
    mapTypeControl: false,
    //control de rotacion
    rotateControl: false,
    //control de escala
    scaleControl: false,
    //control de vista
    streetViewControl: false,
})

geocode({ address: $('#txtLocation').val() })

