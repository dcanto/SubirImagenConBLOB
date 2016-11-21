<?php
$servername = "mysql.hostinger.es";
$username = "u889348891_conus";
$dbpass = "tenten";
$dbname = "u889348891_condb";

// Create connection
$conn = mysqli_connect($servername, $username, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Material_ID, Material_Foto FROM materiales";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["Material_ID"]. " - Foto:
        <img src='data:image;base64," . base64_encode($row["Material_Foto"]) ."'/><br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
