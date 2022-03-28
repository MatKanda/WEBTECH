$(document).ready(()=> {
    alert("Chvíľu trvá kým sa cez API naťahajú všetky dáta");
    $.ajax({
        type: "GET",
        url: "https://geo.ipify.org/api/v1?apiKey=at_IPGpV8HZvEzaRCcM9SmiMAcUZdBmy",
        success: function (data) {
            city = data.location.city;
            state=data.location.country;
            lat = data.location.lat;
            lng = data.location.lng;
            // $("#city").append(document.createElement("h1").innerHTML="Predpoveď počasia v meste: "+city);
            $("#ip").append(document.createElement("p").innerHTML="IP adresa: "+data.ip);
            $("#city").append(document.createElement("p").innerHTML="Mesto: "+city);
            $("#state").append(document.createElement("p").innerHTML="Štát: "+state);
            $("#coordinates").append(document.createElement("p").innerHTML="Šírka: "+lat+"° Dĺžka: "+lng+"°");
            $.ajax({
                type: "GET",
                url: "https://restcountries.eu/rest/v2/alpha/"+state,
                success: function (data) {
                    $("#capital").append(document.createElement("p").innerHTML="Hlavné mesto: "+data["capital"]);
                }
            })
        }
    })
})

