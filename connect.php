
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cdesign";

$con = mysqli_connect($servername, $username, $password, $database);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$con->ping()) {
    $con = new mysqli($servername, $username, $password, $database);
} else {
    echo "";
}
?>
