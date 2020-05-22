<?php

//this is the session check for this page
session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="dealer")) //user not logged in or user logged in is a dealer
{
    header('location:index.php');
}

include("dbconnect.php");

$cusid = $_SESSION['userid']; //getting the customer id
$cusname = $_SESSION['username'];

$carid=$_REQUEST["carid"];
$cartype=$_REQUEST["cartype"];
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $cusname."'s " ?> Payments - Rustom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="icon.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<style>
.paymentbox
{
    font-size:22px;
    margin:100px auto;
    width:70%;
    box-shadow: 0 0 6px 0 #5F396F;
    padding:50px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}

.button
{
    background-color:#5F396F;
    margin-top:35px;
    padding:10px;
    width:300px;
    color:white;
    text-align:center;
    border-radius:5px;
    cursor:pointer;
    transition:all 0.2s ease-in-out;
}

.button:hover
{
    background-color:#C39BD3;
}

#title
{
    font-size:40px;
    margin-bottom:40px;
}

@media screen and (max-width:769px)
{
    .paymentbox
    {
        width:90%;
        font-size:20px;
    }

    #title
    {
        font-size:32px;
    }

    .button
    {
        width:100%;
    }
}   

</style>

<body>

<div class="input-group mb-3 paymentbox">
<span id="title">PAYMENTS SECTION&#129297</span>

<span style="text-align:justify">For now this is a dummy page. <b>In future, this will be redirected to a 3rd party payment gateway site.</b> Till then you can buy any car for free&#128540! Happy <i>Rustoming!</i></span>

<div class="button" onclick="buycar(<?php echo $carid.',\''.$cartype.'\'' ?>)">Buy Car</div>
<div class="button" style="background-color:#E74C3C;margin-top:10px" onclick="goback()">Go Back</div>

</div>



</body>

<script>
function buycar(carid,cartype)
{
  window.location.href="buycar.php?carid="+carid+"&cartype="+cartype;
}

function goback()
{
    window.history.back();
}
</script>

</html>