let imgSource;
let imageOrder = "";
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
})

$(document).ready(function(){
    let consent = getCookie("consent");
    if (consent == null || consent == "")
        document.getElementById("cookies").style.display = "block";
    $.getJSON("photos.json", function(json) {
        imgSource = json;
        loadImg(imgSource,"#images");
    });
    $(function() {
        $("#images").sortable({
            update: function(event, ui) {
                getIdsOfImages();
            }
        });
    });
})


function getIdsOfImages() {
    let values = "";
    $('.image').each(function (index) {
        values += $(this).attr("id") + ":";
    });
    let cookie = getCookie("imgOrder");
    console.log(cookie);
    if(values.length < cookie.length){
        let newArray = "";
        let j = 0;
        for(let i = 0; i < cookie.length;i+=2){
            if(!values.includes(cookie[i])){
                newArray+= cookie[i] +":";
            }
            else{
                newArray += values[j]+":";
                j+=2;
            }
        }
        console.log(newArray);
        setCookie("imgOrder",newArray,7);
    }
    else if(values!= null || values.length!=0){
        setCookie("imgOrder",values,7);
    }


}

function loadImg(imgSource,target){
    let cookie = getCookie("imgOrder");
    if(cookie != null && cookie.length !=0){
        let newOrder = cookie.split(":");
        for(i =0; i < newOrder.length; i++)
        {
            let currentPhoto = imgSource.photos[newOrder[i]];
            if (currentPhoto == null)
                continue;
            loadImgFromJson(currentPhoto,newOrder[i],target);
        }
    }
    else{
        for(let i=0; i < imgSource.photos.length; i++){
            loadImgFromJson(imgSource.photos[i],i,target);
            imageOrder += i + ":";
        }
        setCookie("imgOrder",imageOrder,8);
    }

}

function loadImgFromJson(photo,index,target){
    let img = new Image();
    let src = photo.src;
    img.setAttribute("src", src);
    img.setAttribute("alt", photo.title);
    img.setAttribute("id",index);
    img.setAttribute("class","image");


    let tag="a-" + index;
    $(target).append('<a href="' + src + '" data-title="' + photo.title  + ". <br>" + photo.description  + '" data-lightbox="roadtrip" id="' + tag + '" data-alt="' + photo.title  + '"></a>');
    document.getElementById(tag).appendChild(img);
}

function search(){
    let searchInput = document.getElementById("searchInput").value;
    document.getElementById("images").innerHTML= "";
    let filter = searchInput.toLowerCase();
    let cookie = getCookie("imgOrder");
    if(cookie != null && cookie.length !=0){
        let newOrder = cookie.split(":");
        console.log("newOrder is: " +newOrder);
        for(i =3; i < newOrder.length-6; i++)
        {
            console.log("i " +i);
            let currentPhoto = imgSource.photos[newOrder[i]];
            //console.log("currentPhoto is "+currentPhoto.title);
            if (currentPhoto.title.toLowerCase().includes(filter) || searchInput==null){
                loadImgFromJson(currentPhoto,newOrder[i],"#images");
            }
        }
    }
}

$(document).ready(function() {

    $(".lb-closeContainer").append(document.getElementById("slideshowButton"));
    $(".lb-closeContainer").append(document.getElementById("slideshowStopButton"));
    $("#slideshowButton").click(function () {
        let interval = window.setInterval(function () {
            $(".lb-next").click();
            $(".lb-close").click(function () {
                window.clearInterval(interval)
            })
            $("#slideshowStopButton").click(function () {
                window.clearInterval(interval)
            });
        }, 2000);
    });

})

function setCookie(name,value,days){
    let expires = "";
    let date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}


function getCookie(inputName) {
    let name = inputName + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    let cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        let eqPos = cookie.indexOf("=");
        let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

function enableCookies()
{
    setCookie("enableCookies",1,true);
    $("#cookies").remove();
}
