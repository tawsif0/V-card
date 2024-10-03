<?php
$servername = "sql210.infinityfree.com";
$username = "if0_37434006";
$password = "JRnK3Lak8dUPL6";
$database = "if0_37434006_cdesign";

$con = mysqli_connect($servername, $username, $password, $database);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$con->ping()) {
    $con = new mysqli($servername, $username, $password, $database);
} else {
    echo "";
}
?>