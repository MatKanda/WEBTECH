<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Bratislava');
?>

<?php
$root="files/";
if(isset($_GET['folder'])) {
    if ($_GET['folder']=="subdir"){
        $dir=$root . $_GET['folder'];
    }
    else
        $dir="files";
}else
    $dir="files";

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie1</title>
<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">-->
    <link href="custom.css" rel="stylesheet">
</head>

<body>
<ul>
    <li><a href="http://147.175.98.72/Zadanie1/">Home</a></li>
    <li id="myBtn">Upload</li>
</ul>

<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Select file to upload</h2>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <form action="upload.php" method="post" enctype="multipart/form-data"><br>
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit"><br>
                <h3>Select the name of the file: </h3>
                <input class="inputStyle" type="text" name="fileName" placeholder="File name">
            </form>
        </div>
    </div>
</div>


    <h1>Nejaké tie infošky</h1>
    <table id="table">
        <thead class="tbl-header">
        <tr>
            <th>File name</th>
            <th>File type</th>
            <th>File size</th>
            <th>Upload date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $files=scandir($dir,SCANDIR_SORT_ASCENDING);

//        $dir="files";
        foreach ($files as $file) {

            if($file==".") {
                continue;
            }

            if(strcmp($dir."/",$root)==0 && $file=="..")
                continue;
            echo "<tr>";

            if(is_dir($dir."/".$file) && ($file)!=".."){
                echo "<td><a href='"."?folder=".$file."'>subdir</a></td>";
            }elseif (strcmp($dir,$root)!=0 && $file==".."){
                echo "<td><a href='http://147.175.98.72/Zadanie1/'>..</a></td>";
            }else
                echo "<td>", $file, "</td>";

//                echo $dir . "/" . $file."<br>";
                if($file==".." || is_dir($dir."/".$file)){
                    echo "<td>", filetype($dir . "/" . $file), "</td>";
                    echo "<td>", "", "</td>";
                    echo "<td>", "", "</td>";
                }else {

                    echo "<td>", filetype($dir . "/" . $file), "</td>";
                    echo "<td>", filesize($dir . "/" . $file), "</td>";
                    echo "<td>", date("F d Y H:i:s.",filectime( $dir."/".$file)), "</td>";
                }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script  src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="custom.js"></script>
</body>
</html>