<?php
date_default_timezone_set("Europe/Bratislava");

$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST['fileName']) && $_POST['fileName']!="") {
//    echo "filename je setnuty"."<br>";
    $target_file = $target_dir . $_POST['fileName'] . "." . $imageFileType;
}


// Check if file already exists
if (file_exists($target_file)) {
    if(isset($_POST['fileName']) && $_POST['fileName']!="") {
//        $target_file= $target_dir . $_POST['fileName'] . "_". date("h") . ":" . date("m") . ":" . date("s") . "." . $imageFileType;
        $target_file= $target_dir . $_POST['fileName'] . "_".  date("h:i:s")  . "." . $imageFileType;
    } else{
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"],".".$imageFileType)."_".date("h:i:s"). "." . $imageFileType;
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header("Refresh:0; url=index.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
