<?php

$servername="localhost";
$database="cars";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    die("Connection error: " . mysqli_connect_errno());
}
?>