<?php
$mysql_host = "localhost:3306";
$mysql_user = "hch";
$mysql_password = "4597";
$mysql_db ="debug";

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

if($conn == false) {
    die();
}

?>