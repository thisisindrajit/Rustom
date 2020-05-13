<?php

$servername="localhost";
$database="cars";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    header("Location: error.php");
}

?>