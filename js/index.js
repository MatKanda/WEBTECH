
$(document).ready(()=>{
    alert("Chvíľu trvá kým sa cez API naťahajú všetky dáta");
        $.ajax({
            type: "GET",
            url: "https://geo.ipify.org/api/v1?apiKey=at_IPGpV8HZvEzaRCcM9SmiMAcUZdBmy",
            success:function(data) {
                console.log(data);
                console.log(data.ip);
                var city=data.location.city;
                var lat=data.location.lat;
                var lng=data.location.lng;
                // $("#city").append(document.createElement("h1").innerHTML="Predpoveď počasia v meste: "+city);
                var h1=document.createElement("h1");
                h1.innerHTML="Predpoveď počasia v meste "+city;
                var div=document.getElementById("city");
                div.append(h1);
                console.log("lat: "+lat+" lng: "+lng);
                    $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "https://community-open-weather-map.p.rapidapi.com/forecast?lang=sk&lat="+lat+"&lon="+lng,
                        "method": "GET",
                        "headers": {
                            "x-rapidapi-key": "9d5c08c066msh5410f0f5ee8414cp1728b7jsnf92c15f0a720",  //5e98cec137mshceaac5f6453eba1p1e1333jsnefdcabcf435d
                            "x-rapidapi-host": "community-open-weather-map.p.rapidapi.com"
                    },
                    success:function (data){
                        console.log(data);
                        for(var i=0;i<=5;i++) {
                            var img=document.createElement("img");
                            img.id="img"+i;
                            img.alt="weather icon";
                            img.src="http://openweathermap.org/img/w/"+data.list[i*7+3]["weather"][0]["icon"]+".png";
                            $("#"+i).append(img);


                            var date=data.list[i*7+3]["dt_txt"].split(" ")[0];
                            var weather=data.list[i*7+3].weather[0]["description"];
                            var wind=data.list[i*7+3].wind["speed"];
                            var temp=data.list[i*7+3].main["temp"];
                            var feelsLike=data.list[i*7+3].main["feels_like"];
                            temp=Math.round(temp-272.15);
                            feelsLike=Math.round(feelsLike-272.15);
                            wind=Math.round(wind*3.6);
                            $("#"+i).append(document.createElement("p").innerHTML="<br>"+date+"<br>Počasie: "+weather+"<br>Vietor: "+wind+"km/h<br>Teplota: "+temp+"°C<br>Pocitovo: "+feelsLike+"°C");
                        }
                    }

                });
            }
        })
});

function returnDay(date){
    if(date===0){
        return "Pondelok";
    }
    else if(date===1){
        return "Utorok";
    }
    else if(date===2){
        return "Streda";
    }
    else if(date===3){
        return "tvrtok";
    }
    else if(date===4){
        return "Piatok";
    }
    else if(date===5){
        return "Sobota";
    }
    else if(date===6){
        return "Nedela";
    }
}

// $.ajax({
//     "async": true,
//     "crossDomain": true,
//     "url": "https://community-open-weather-map.p.rapidapi.com/weather?lat="+lat+"&lon=0&callback=test&id=2172797&lang="+lng+"&units=%22metric%22%20or%20%22imperial%22&mode=xml%2C%20html",
//     "method": "GET",
//     "headers": {
//     "x-rapidapi-key": "5e98cec137mshceaac5f6453eba1p1e1333jsnefdcabcf435d",
//         "x-rapidapi-host": "community-open-weather-map.p.rapidapi.com"
//     }
// });


// $.ajax(settings).done(function (response) {
//     console.log(response);
// });

//
//
// var unirest = require("unirest");
//
// var req = unirest("GET", "https://wft-geo-db.p.rapidapi.com/v1/geo/adminDivisions");
//
// req.headers({
//     "x-rapidapi-key": "5e98cec137mshceaac5f6453eba1p1e1333jsnefdcabcf435d",
//     "x-rapidapi-host": "wft-geo-db.p.rapidapi.com",
//     "useQueryString": true
// });
//
//
// req.end(function (res) {
//     if (res.error) throw new Error(res.error);
//
//     console.log(res.body);
// });