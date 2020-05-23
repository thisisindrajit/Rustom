<?php

//this is the session check for this page
session_start();

include("dbconnect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank you! - Rustom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="icon.ico">
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
<span id="title">SWEET!&#127853</span>

<span style="text-align:justify">First things first, thank you&#129321 for registering with Rustom!<b> A verification mail has been sent to your e-mail ID.</b> Open it and click on the verification link to activate your account! Happy <i>Rustoming!</i></span>

<div class="button" onclick="gotohome()">Go to homepage</div>

</div>



</body>

<script>
function gotohome() {

    window.location.href="index.php";
}
</script>
</html>