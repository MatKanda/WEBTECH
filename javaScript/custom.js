function checkValueX(){
    let x=document.getElementById("valueX").value;
    if(x<1 || x>9 || x==""){
        document.getElementById("errorX").style.display="block";
        document.getElementById("valueX").style.color="red";
    }
    else {
        document.getElementById("errorX").style.display="none";
        document.getElementById("valueX").style.color="white";
    }
}

function checkValueY(){
    let x=document.getElementById("valueY").value;
    if(x<1 || x>9){
        document.getElementById("errorY").style.display="block";
        document.getElementById("valueY").style.color="red";
    }
    else {
        document.getElementById("errorY").style.display="none";
        document.getElementById("valueY").style.color="white";
    }
}



//inspired by https://stackoverflow.com/questions/14643617/create-table-using-javascript
// and https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model/Traversing_an_HTML_table_with_JavaScript_and_DOM_Interfaces

function tableXorY(i,j,cell){
    console.log("som v x or y");
    if (i == 0 && j == 0){
        cell.appendChild(document.createTextNode(" "));
    }
    else if (j == 0 && i != 0) {
        cell.appendChild(document.createTextNode("Y = " + i));
    }
    else if (i == 0){
        cell.appendChild(document.createTextNode("X = " + j));
    }
    else {
        cell.appendChild(document.createTextNode(i*j));
    }
}

function exitFromTable(){
    document.getElementById("myModal").style.display="none";
}


function showTable(){
    let x=parseInt(document.getElementById("valueX").value,10);
    let y=parseInt(document.getElementById("valueY").value,10);
    console.log(x,y);
    if(isNaN(x) || x<1 || x>9){
        document.getElementById("errorX").style.display="block";
    }
    else if (isNaN(y) || y<1 || y>9){
        document.getElementById("errorY").style.display="block";
    }
    else{
        makeTable(x,y);
        document.getElementById("myModal").style.display = "block";
    }
}

function makeTable(x,y){
    if(document.getElementById("makingTable")!=null) {
        document.getElementById("makingTable").remove();
    }

    let myModal = document.getElementById("myModal");
    let table = document.createElement('table');
    table.setAttribute("id", "makingTable");

    for (let i = 0; i <= y; i++) {
        let row = table.insertRow();
        for (let j = 0; j <= x; j++) {
            let cell = row.insertCell();
            tableXorY(i, j, cell);
        }
    }
    myModal.appendChild(table);
}

