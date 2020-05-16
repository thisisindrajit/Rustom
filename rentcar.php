<?php

session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="dealer")) //user not logged in or user logged in is a dealer
{
    header('location:index.php');
}

include("dbconnect.php");

$cusid = $_SESSION['userid']; //getting the customer id
$carid=$_POST["carid"];
$date=$_POST["date"];


$checkifalreadyrented = "select * from rent where rentalcarid=$carid and enddate is null";
$checkex = mysqli_query($conn, $checkifalreadyrented);

if(mysqli_num_rows($checkex)===0)
{
//query to insert into rent table
$setrent = "insert into rent(rentalcarid,customerid,startdate,rentdate) values ($carid,$cusid,STR_TO_DATE('$date', '%d-%c-%Y'),CURRENT_TIMESTAMP())";
$ex = mysqli_query($conn, $setrent);

if($ex)
{
    $rentedquery = "update car set status = 'rented' where carid = $carid";

    if(mysqli_query($conn,$rentedquery))
    {
    $_SESSION["rentedcar"]=true; //indicating user has bought a new car
    echo "success";
    }

    else
    {
        echo "Some error occured while trying to update the car's status!";
    }
}

else
{
    echo "error while renting car!";
}

}

else
{
    echo "rented";
}

?>