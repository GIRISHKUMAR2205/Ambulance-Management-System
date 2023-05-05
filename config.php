<?php
$hostname="localhost";
$username="root";
$password="";

$databaseName = "ambulance";

$db= mysqli_connect($hostname,$username,$password,$databaseName);
if ($db===false)
{
    die("error".mysqli_connect_error());
    echo "FUCK";
}

?>