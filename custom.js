var tableLength=document.getElementById("table");
$(document).ready(function() {
    $('#table').DataTable( {
        "pageLength": 80000,
        "paging": false,
        columnDefs:[
            // {targets:[1], orderData:[10,11]}
        ]
    } );
} );

document.getElementById("updateData").addEventListener("click",function (){
    document.getElementById("loader").style.display="block";
})

var modal = document.getElementById("myModal");
var btns = document.getElementsByClassName("myBtn");
var span = document.getElementsByClassName("close")[0];
for(var i = 0; i < btns.length; i++) {
    var btn = btns[i];
    btn.onclick = function() {
        modal.style.display = "block";
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


$('#table').on('click', 'td',function (e) {
    e.preventDefault();
    var table = $('#table').DataTable();
    var data = table.row($(this).closest('tr')).data();
    var cell = table.cell($(this).closest('td')).data();
    console.log(data, cell);
    for(var i=0;i<data.length;i++){
        if(data[i]===cell) {
            var lecture = i - 1;
            break;
        }
    }
    $.ajax({
        type: "GET",
        // data: {data:data, cell:cell},
        url: "http://147.175.98.72/Zadanie4/fckinModal.php?name="+data[0]+"&surname="+data[1]+"&lecture="+lecture,
        success:function(data) {
            data=JSON.parse(data);
            console.log(data);
            document.getElementById("modal-content").innerHTML="";
            var br = document.createElement("br");
            for(var i=0;i<data.length;i++){
                console.log(data[i]["action"]+" "+data[i]["timestamp"]);
                var p=document.createElement("p");
                var string=document.createTextNode(data[i]["action"]+" : "+data[i]["timestamp"]);
                p.appendChild(string);
                document.getElementById("modal-content").appendChild(p);
            }
        }
    });
});

