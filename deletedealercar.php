<?php

session_start();
include("dbconnect.php");

$carid = $_REQUEST["carid"];
$cartype = $_REQUEST["cartype"];
$dealerid = $_SESSION['userid'];
$status = $_REQUEST['status'];

if($status==="sold out"||$status==="rented")
{
    $_SESSION["deletesoldoutcar"]=true;
    header("location: dealer_index.php");
}

else
{

$query2 = "delete from features where carid = $carid";

if(!mysqli_query($conn, $query2))
{
    echo "Error occured while deleting features!";
    header("Location: error.php");
}

$query5 = "delete from images where carid = $carid";

if(!mysqli_query($conn, $query5))
{
    echo "Error occured while deleting images!";
    header("Location: error.php");
}



if($cartype==="new")
{
    $query3 = "delete from newcar where newcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting new car!";
    header("Location: error.php");
    }
}

else if($cartype==="resale")
{
    $query3 = "delete from preownedcar where preownedcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting pre owned car!";
    header("Location: error.php");
    }
}

else
{
    $query3 = "delete from rentalcar where rentalcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting rental car!";
    header("Location: error.php");
    }
}

$query4 = "delete from owns where carid = $carid and dealerid = $dealerid";

if(!mysqli_query($conn, $query4))
{
    echo "Error occured while deleting ownership!";
    header("Location: error.php");
}


$query1 = "delete from car where carid = $carid";

if(!mysqli_query($conn, $query1))
{
    echo "Error occured while deleting car!";
    header("Location: error.php");
}

else
{
    $_SESSION["deletedcar"]=true;
    header("Location:dealer_index.php");
}

}


?>