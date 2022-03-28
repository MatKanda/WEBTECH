function map() {
    var mymap = L.map('mapid');
    mymap.setView([48.153, 17.073], 17);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibXVmZmluZWsiLCJhIjoiY2tndjVkbjliMGlwbDJ4cGo0aGV2dXNkaSJ9._Pz3_lRO8sH9bsGzTT9JNw'
    }).addTo(mymap);

    var bufet = L.polygon([
        [48.153847454807824, 17.073081135749817],
        [48.153847454807824, 17.073445916175842],
        [48.153983448226825, 17.073445916175842],
        [48.153983448226825, 17.073081135749817],],{
        fillColor : '#980',
        color : '#980'
    }).addTo(mymap);
    bufet.bindPopup("Toto je bufetik dole na E-čku");

    var blockA = L.polygon([
        [48.15182898379371, 17.072818279266357],
        [48.15182898379371, 17.073875069618225],
        [48.151964982562305, 17.073875069618225],
        [48.151964982562305, 17.072818279266357],
    ]).addTo(mymap);
    blockA.bindPopup("Blok 'A' <br> Ústav jadrového a fyzikálneho inžinierstva");

    var blockD = L.polygon([
        [48.15333926568372, 17.073188424110413],
        [48.15333926568372, 17.074384689331055],
        [48.15348599686311, 17.074384689331055],
        [48.15348599686311, 17.073188424110413],],{
        fillColor : '#189',
        color : '#189'
    }).addTo(mymap);
    blockD.bindPopup("Blok 'D' <br> Ústav automobilovej mechatroniky");

    var library = L.polygon([
        [48.15197214038225, 17.072560787200928],
        [48.15197214038225, 17.072818279266357],
        [48.15249465854117, 17.072818279266357],
        [48.15249465854117, 17.072560787200928],],{
        fillColor : '#470',
        color : '#470'
    }).addTo(mymap);
    library.bindPopup("Asi knižnica, idk nikdy som tam nebol");

    var hall = L.polygon([
        [48.153511048485974, 17.072566151618958],
        [48.153511048485974, 17.072834372520447],
        [48.15409081119775, 17.072834372520447],
        [48.15409081119775, 17.072566151618958]],{
        fillColor : '#f03',
        color : '#f03'
        },
        ).addTo(mymap);
    hall.bindPopup("Telocvična kedže informatici radi športujú");

    var blockC = L.polygon([
            [48.152831071526535, 17.072820961475372],
            [48.152831071526535, 17.073875069618225],
            [48.15296885705943, 17.073875069618225],
            [48.15296885705943, 17.072820961475372]],{
            fillColor : '#f09',
            color : '#f09'
        },
    ).addTo(mymap);
    blockC.bindPopup("Blok 'C' <br> Úsrav elektrotechniky a aplikovanej informatiky");

    var bus1 = L.marker([48.148331365321255, 17.072027027606964]).addTo(mymap);
    bus1.bindPopup("Botanická záhrada <br> 29,32,N29,N33,N34");

    var bus2 = L.marker([48.14791886505443, 17.072305977344513]).addTo(mymap);
    bus2.bindPopup("Botanická záhrada <br> 29,32,N29,N33,N34");

    var bus3 = L.marker([48.154123020045226, 17.07512229681015]).addTo(mymap);
    bus3.bindPopup("Zoo <br> 31,39,N31");

     var bus4 = L.marker([48.154606150331134, 17.074564397335052]).addTo(mymap);
     bus4.bindPopup("Zoo <br> 31,39,N31");

    var elektr1 = L.circle([48.14813003697183, 17.072472274303436], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 8
    }).addTo(mymap);
    elektr1.bindPopup("Botanická záhrada <br> 4,9");

    var eletrk2 = L.circle([48.14813898491524, 17.071777582168576], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 8
    }).addTo(mymap);
    eletrk2.bindPopup("Botanická záhrada <br> 4,9");


    L.Control.geocoder().addTo(mymap);


    L.Routing.control({
        waypoints: [
            L.latLng(),
            L.latLng(48.152874, 17.073533)
        ],
        routeWhileDragging: true,
        geocoder: L.Control.Geocoder.nominatim(),
    }).addTo(mymap);

}
