
$(document).ready(function() {
    $('#table').DataTable( {
        "pageLength": 40000,
        "paging": false,
        columnDefs:[
            { "orderable":false ,"targets":[0,3,4,6]},
            {targets:[5], orderData:[5,2]}
            ]
    } );
    $('#table2').DataTable( {
        "pageLength": 40000,
        "paging": false,
        columnDefs:[
            { "orderable":false ,"targets":[2,4]}
        ]
    } );
} );

var modal = document.getElementById("myModal");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}