<?php

session_start();
include("dbconnect.php");

$carid = $_REQUEST["carid"];
$cartype = $_REQUEST["cartype"];
$dealerid = $_SESSION['userid'];
$status = $_REQUEST['status'];

if($status==="sold out")
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
}

$query5 = "delete from images where carid = $carid";

if(!mysqli_query($conn, $query5))
{
    echo "Error occured while deleting images!";
}



if($cartype==="new")
{
    $query3 = "delete from newcar where newcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting new car!";
    }
}

else if($cartype==="resale")
{
    $query3 = "delete from preownedcar where preownedcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting pre owned car!";
    }
}

else
{
    $query3 = "delete from rentalcar where rentalcarid = $carid";

    if(!mysqli_query($conn, $query3))
    {
    echo "Error occured while deleting rental car!";
    }
}

$query4 = "delete from owns where carid = $carid and dealerid = $dealerid";

if(!mysqli_query($conn, $query4))
{
    echo "Error occured while deleting ownership!";
}


$query1 = "delete from car where carid = $carid";

if(!mysqli_query($conn, $query1))
{
    echo "Error occured while deleting car!";
}

else
{
    $_SESSION["deletedcar"]=true;
    header("Location:dealer_index.php");
}

}


?>