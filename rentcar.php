<?php

session_start();

if(!isset($_SESSION['logged_in'])) //user not logged in
{
    header('location:index.php');
}

include("dbconnect.php");

$type=$_POST["type"];


if($type==="start")
{
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
        header("Location: error.php");
    }
}

else
{
    echo "error while renting car!";
    header("Location: error.php");
}

}

else
{
    echo "rented";
}
}


else
{
    $carid=$_POST["carid"];
    $cusid=$_POST["customerid"];
    $startdate=$_POST["startdate"];

    $endrent = "update rent set enddate=CURRENT_TIMESTAMP() where rentalcarid=$carid and customerid=$cusid and startdate='$startdate'";
    $ex = mysqli_query($conn, $endrent);

    if($ex)
    {
        $statusquery = "update car set status = 'available' where carid = $carid";

        if(mysqli_query($conn,$statusquery))
        {
        $_SESSION["finishedrent"]=true; //indicating user has bought a new car
        echo "success";
        }
    
        else
        {
            echo "Some error occured while trying to update the car's status!";
            header("Location: error.php");
        }
    }

    else
    {
        echo "Error occured while ending the rent!";
        header("Location: error.php");
    }

}
?>