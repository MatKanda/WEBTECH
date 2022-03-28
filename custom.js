function optionOther() {
    let x = document.getElementById("other_input");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}


function radioOption(id){
    document.getElementById("male_input").style.display = 'none';
    document.getElementById("female_input").style.display = 'none';
    if (id === "male_input") {
        document.getElementById("male_input").style.display = 'block';
    } else {
        document.getElementById("female_input").style.display = 'block';
    }

}


function validateAge() {
    let today = new Date();

    let birthYear = new Date(document.getElementById("birth").value).getFullYear();
    let birthMonth = new Date(document.getElementById("birth").value).getMonth();
    let birthDay = new Date(document.getElementById("birth").value).getDate();

    let years = parseInt(document.getElementById("years").value, 10);


    if (birthMonth > today.getMonth() && birthYear + years == today.getFullYear()-1) {
        console.log("Som v prvom ife")
        console.log("correct");
        return true;
    }
    else if(birthMonth == today.getMonth() && birthDay>=today.getDate() && birthYear + years == today.getFullYear()){
        console.log("Som v druhom ife")
        console.log("correct");
        return true;
    }
    else if (birthMonth < today.getMonth() && birthYear + years == today.getFullYear()){
        console.log("Som v tretom ife")
        console.log("correct");
        return true;
    }
    else if(birthMonth == today.getMonth() && birthDay<today.getDate() && birthYear + years == today.getFullYear()) {
        console.log("Som v stvrtom ife")
        console.log("correct");
        return true;
    }
     else {
        console.log("Som v else")
        console.log("incorrect");
        alert("Vek sa nezhoduje s vašim dátumom narodenia");
        return false;
    }

}

function validateText(input){
    let length=input.value.length;
    console.log(length)
    if (length<=2){
        input.style.borderColor="red";
        return false;
    }
    else
        input.style.borderColor="green";

}

function validateMail(){
    let mail=document.getElementById("mail").value;
    let x=mail.split('@');
    if(x[0].length<=3) {
        alert("pre@ word must longer than 3 letters");
        return false;
    }
    let y=mail.split('.');
    if(y.length<3 || y[2].length<2 || y[2].length>4){
        alert("domain is incorrect")
        return false;
    }
}

function displaycontinue()
{
    if (document.getElementById('aboutMeYes').checked){
        document.getElementById('selectMenu').style.display = "block";
        document.getElementById("sad").style.display="none";
        document.getElementById('selectChild1').removeAttribute("disabled");
        document.getElementById('selectChild2').removeAttribute("disabled");
        document.getElementById('selectChild3').removeAttribute("disabled");
    }

    else{
        document.getElementById('selectMenu').style.display = "none";
        document.getElementById("sad").style.display="block";
        document.getElementById('selectChild1').setAttribute("disabled",true);
        document.getElementById('selectChild2').setAttribute("disabled",true);
        document.getElementById('selectChild3').setAttribute("disabled",true);
    }
}

var selectOptions =
    {

        age: ["do18", "nad18"],
        do18 : ["ZS","SS"],
        nad18 : ["Univerzita", "Praca"],
        ZS : ["Prvý stupeň", "Druhý stupeň"],
        SS : ["Pred maturitou", "Maturitný ročník"],
        Univerzita : ["1. stupeň", "2. stupeň"],
        Praca : ["Spokojný", "Nespokojný"]
    };

function fckingLists(element)
{
    let childOptions = '';
    if (element.id == "selectChild1"){
        for (i=0;i<selectOptions[element.value].length;i++){ // change second select values
            childOptions = childOptions + "<option value=\""+ selectOptions[element.value][i] + "\"" + (i==0 ? "checked" : "") + ">" + selectOptions[element.value][i] + "</option>";
        }
        document.getElementById("selectChild2").innerHTML = childOptions;
        childOptions = '';
        for (i=0;i<selectOptions[selectOptions[element.value][0]].length;i++){
            childOptions = childOptions + "<option value=\"" + selectOptions[selectOptions[element.value][0]][i] + "\"" + (i==0 ? "checked" : "") + ">" + selectOptions[ selectOptions[element.value][0] ][i] + "</option>";
        }
        document.getElementById("selectChild3").innerHTML = childOptions;
    } else if (element.id == "selectChild2"){
        for (i=0;i<selectOptions[element.value].length;i++){
            childOptions = childOptions + "<option value=\"" + selectOptions[element.value][i] + "\"" + (i==0 ? "checked" : "") + ">" + selectOptions[element.value][i] + "</option>";
        }
        document.getElementById("selectChild3").innerHTML = childOptions;
    }
}
