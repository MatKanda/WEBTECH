//
// document.getElementById("getNameByDate").addEventListener("click",()=> {
// $.ajax({
//     type: "GET",
//     url: "http://147.175.98.72/Zadanie6/search/?date=0102",
//     success:function(data) {
//         console.log(data);
//         document.getElementById("firstResult").innerHTML="SK: "+data.SK+"<br>"+"CZ: "+data.CZ+"<br>"+
//         "HU: "+data.HU+"<br>"+"AT: "+data.AT+"<br>"+"PL: "+data.PL;
//     }
//     })
// });
//
// document.getElementById("getDateByNameState").addEventListener("click",()=> {
//     $.ajax({
//         type: "GET",
//         url: "http://147.175.98.72/Zadanie6/search/?name=Radom%C3%ADr&&state=SK",
//         success:function(data) {
//             console.log(data);
//             document.getElementById("secondResult").innerHTML="Meno: "+data.SK+", deň: "+data.den;
//         }
//     })
// });
// document.getElementById("selectOptions").addEventListener("input",()=> {
//     var select=document.getElementById("selectOptions");
//     var url=null;
//     if(select.value==="holidaySK")
//         url="http://147.175.98.72/Zadanie6/holidaySK";
//     else if(select.value==="holidayCZ")
//         url="http://147.175.98.72/Zadanie6/holidayCZ";
//     else if(select.value==="memorialDaySK")
//         url="http://147.175.98.72/Zadanie6/memorialDaySK";
//     $.ajax({
//         type: "GET",
//         url: url,
//         success:function(data) {
//             console.log(data);
//             // document.getElementById("secondResult").innerHTML="Meno: "+data.SK+", deň: "+data.den;
//         }
//     })
// });
function first(){
    var date=document.getElementById("date").value;
    if(event.key === 'Enter'){
        $.ajax({
        type: "GET",
        url: "http://147.175.98.72/Zadanie6/search/?date="+date,
        success:function(data) {
            console.log(data);
        }
    })}
}

function second(){
    var name=document.getElementById("name").value;
    var state=document.getElementById("state").value;
    if(event.key === 'Enter'){
    $.ajax({
        type: "GET",
        url: "http://147.175.98.72/Zadanie6/search/?name="+name+"&&state="+state,
        success:function(data) {
            console.log(data);
        }
    })}
}

document.getElementById("SKholiday").addEventListener("click",()=> {
    $.ajax({
        type: "GET",
        url: "http://147.175.98.72/Zadanie6/holidaySK",
        success:function(data) {
            console.log(data);
        }
    })
});

document.getElementById("SKmemorial").addEventListener("click",()=> {
    $.ajax({
        type: "GET",
        url: "http://147.175.98.72/Zadanie6/memorialDaySK",
        success:function(data) {
            console.log(data);
        }
    })
});

document.getElementById("CZholiday").addEventListener("click",()=> {
    $.ajax({
        type: "GET",
        url: "http://147.175.98.72/Zadanie6/holidayCZ",
        success:function(data) {
            console.log(data);
        }
    })
});

document.getElementById("addNew").addEventListener("click",()=> {
    $.ajax({
        type: "POST",
        data: {date: "0101", name: "Gizela"},
        url: "http://147.175.98.72/Zadanie6/addName/",
        success:function(data) {
            console.log(data);
        }
    })
});
