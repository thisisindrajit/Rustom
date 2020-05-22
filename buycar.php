<?php 

session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="dealer")) //user not logged in or user logged in is a dealer
{
    header('location:index.php');
}

include("dbconnect.php");

$cusid = $_SESSION['userid']; //getting the customer id
$carid=$_REQUEST["carid"];
$cartype=$_REQUEST["cartype"];

//echo $cusid.",".$carid.",".$cartype;
if($cartype==="new")
{
    $buycarquery = "update newcar set customerid = $cusid,paymentstatus = 'verified',paymentdate = CURDATE() ,paymentstatuschangetime = CURRENT_TIMESTAMP() where newcarid = $carid";

    if(mysqli_query($conn,$buycarquery))
    {
        $soldoutquery = "update car set status = 'sold out' where carid = $carid";

        if(mysqli_query($conn,$soldoutquery))
        {
        $_SESSION["boughtnewcar"]=true; //indicating user has bought a new car
        header("location:cus_index.php");
        }

        else
        {
            echo "Some error occured while trying to update the car table!";
            header("Location: error.php");
        }
    }

    else
    {
        echo "Some error occured while buying the car! Please try again!";
        header("Location: error.php");
    }
}

else //it's going to be a resale car
{
    $buycarquery = "update preownedcar set customerid = $cusid,paymentstatus = 'verified',paymentdate = CURDATE() ,paymentstatuschangetime = CURRENT_TIMESTAMP() where preownedcarid = $carid";

    if(mysqli_query($conn,$buycarquery))
    {
        $soldoutquery = "update car set status = 'sold out' where carid = $carid";

        if(mysqli_query($conn,$soldoutquery))
        {
        $_SESSION["boughtnewcar"]=true; //indicating user has bought a new car
        header("location:cus_index.php");
        }

        else
        {
            echo "Some error occured while trying to update the car table!";
            header("Location: error.php");
        }
    }

    else
    {
        echo "Some error occured while buying the car! Please try again!";
        header("Location: error.php");
    }

}



?>

