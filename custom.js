$( document ).ready(function() {
    $.ajax({
        type : "POST",
        url  : "http://147.175.98.72/Zadanie5/updateDB.php",
        data : { start:"start" },// passing the values
        // success: function(res){
        //     console.log(res);
        // }
    });
});

var source = new EventSource("sse.php");
source.addEventListener("event",(event)=>{
    var data=JSON.parse(event.data);
    console.log(data);
    document.querySelector("#json").innerHTML=event.data;
    document.querySelector("#sin").innerHTML=data.sin;
    document.querySelector("#cos").innerHTML=data.cos;
    document.querySelector("#sin_cos").innerHTML=data.sin_cos;
})

document.getElementById("sinButton").addEventListener("click",()=>{
    $.ajax({
        type : "POST",
        url  : "http://147.175.98.72/Zadanie5/updateDB.php",
        data : { func:"sin" },// passing the values
        // success: function(res){
        //     console.log(res);
        // }
    });
    var dot=document.getElementById("dotSin");
    if(getComputedStyle(dot).getPropertyValue('backGround-color')==="rgb(173, 255, 47)") {
        dot.style.background="red";
    }else{
        dot.style.background="rgb(173, 255, 47)";
    }
})

document.getElementById("cosButton").addEventListener("click",()=>{
    $.ajax({
        type : "POST",
        url  : "http://147.175.98.72/Zadanie5/updateDB.php",
        data : { func:"cos" },// passing the values
        // success: function(res){
        //     console.log(res);
        // }
    });
    var dot=document.getElementById("dotCos");
    if(getComputedStyle(dot).getPropertyValue('backGround-color')==="rgb(173, 255, 47)") {
        dot.style.background="red";
    }else{
        dot.style.background="rgb(173, 255, 47)";
    }
})

document.getElementById("sinCosButton").addEventListener("click",()=>{
    $.ajax({
        type : "POST",
        url  : "http://147.175.98.72/Zadanie5/updateDB.php",
        data : { func:"sin_cos" },// passing the values
        // success: function(res){
        //     console.log(res);
        // }
    });
    var dot=document.getElementById("dotSinCos");
    if(getComputedStyle(dot).getPropertyValue('backGround-color')==="rgb(173, 255, 47)") {
        dot.style.background="red";
    }else{
        dot.style.background="rgb(173, 255, 47)";
    }
})

function sendValue(){
    var lambda=document.getElementById("myRange").value;
    document.getElementById("amount").innerHTML=lambda;
    $.ajax({
        type : "POST",
        url  : "http://147.175.98.72/Zadanie5/updateDB.php",
        data : { func:"lambda", lambdaValue:lambda },// passing the values
        success: function(res){
            console.log(JSON.parse(res));
        }
    });

}