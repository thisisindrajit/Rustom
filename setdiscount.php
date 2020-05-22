<?php
session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="customer")) //user not logged in or user logged in is a customer
{
    header('location:index.php');
}

include("dbconnect.php");

$carid=$_REQUEST["carid"];
$cartype=$_REQUEST["cartype"];
$discount=$_POST["discount"];

//echo $carid.",".$cartype.",".$discount;

if($cartype==="new")
{
    $query = "update newcar set discount=$discount where newcarid=$carid";
    $ex = mysqli_query($conn,$query);

    if($ex)
    {
        $_SESSION['discountset']=true;
        header('location:dealer_index.php');
    }   

    else
    {
    echo "Some error occured while setting discount of new car!";
    }
}

else
{
    $query = "update preownedcar set discount=$discount where preownedcarid=$carid";
    $ex = mysqli_query($conn,$query);
    
    if($ex)
    {
        $_SESSION['discountset']=true;
        header('location:dealer_index.php');
    }
    
    else
    {
        echo "Some error occured while setting discount of resale car!";
    }

}



?>