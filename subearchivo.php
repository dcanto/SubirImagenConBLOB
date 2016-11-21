<?php
$material_id="";
$target_dir = "fotostmp/";
$target_file = $target_dir . basename($_FILES["foto"]["tmp_name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $material_id = $_POST["material_id"];
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (file_get_contents($_FILES['foto']['tmp_name'])) {

        $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

        $servername = "mysql.hostinger.es";
        $username = "u889348891_conus";
        $dbpass = "tenten";
        $dbname = "u889348891_condb";
// Create connection
        $conexion = mysqli_connect($servername, $username, $dbpass, $dbname);
// Check connection
        if (!$conexion) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
// sql to delete a record
            $sql = "UPDATE materiales SET Material_Foto='$foto' WHERE Material_ID='$material_id'";

            if (mysqli_query($conexion, $sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        mysqli_close($conexion);
        echo "The file ". basename( $_FILES["foto"]["tmp_name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
