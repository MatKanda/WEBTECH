var modal = document.getElementById("myModal");

var btns = document.getElementsByClassName("startModal");

var span = document.getElementsByClassName("close")[0];

// btn.onclick = function() {
//     modal.style.display = "block";
// }

for(var i = 0; i < btns.length; i++) {
    var btn = btns[i];
    btn.onclick = function(e) {
        modal.style.display = "block";
            var clickedValue = $(e.target).text();
            $.ajax({
                method:"POST",
                url:"http://147.175.98.72/Zadanie7/value.php",
                data:{state:clickedValue},
                success(data){
                    data=JSON.parse(data);
                    console.log(data);
                    var modal=document.getElementsByClassName("modal-content")[0];
                    modal.innerHTML="";
                    for(var i=0;i<data.length/2;i++){
                        var p=document.createElement("p");
                        p.innerHTML="Používateľ z mesta "+data[2*i]+" => Počet loginov: "+data[2*i+1]+"<br>";
                        modal.append(p);
                    }
                }
            })
    }
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var coordinates=[];
function getCoordinates(response){
    coordinates.push(response);
    console.log(coordinates);

}


$(document).ready(()=> {
    $.ajax({
        url:"http://147.175.98.72/Zadanie7/mapCoordinates.php",
        success(cities){
            cities=JSON.parse(cities);
            console.log(cities);
            for(var i=0;i<cities.length;i++) {
                // setTimeout(()=>console.log(),3000);
                 $.ajax({

                    "crossDomain": true,
                    "url": "https://community-open-weather-map.p.rapidapi.com/forecast?q="+cities[i],
                    "method": "GET",
                    "headers": {
                        "x-rapidapi-key": "9d5c08c066msh5410f0f5ee8414cp1728b7jsnf92c15f0a720",
                        "x-rapidapi-host": "community-open-weather-map.p.rapidapi.com"
                    },
                    success(data) {
                        // console.log(data.city.coord.lat);
                        // console.log(data.city.coord.lon);
                        getCoordinates(data.city.coord.lat);
                        getCoordinates(data.city.coord.lon);
                    }
                })
            }
        }
    })
})


function createMap() {
    var mymap = L.map('mapid');
    mymap.setView([48.153, 17.073], 7);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibXVmZmluZWsiLCJhIjoiY2tudDYxbXRpMGIwdjJ2bjN1NjZxOWJyaSJ9.0lLX0iR1TWUxz1yTJRHIWg'
    }).addTo(mymap);

    for (var i=0;i<coordinates.length/2;i++){
        L.marker([coordinates[2*i], coordinates[2*i+1]]).addTo(mymap);
    }
    // var marker = L.marker([51.5, -0.09]).addTo(mymap);
}

