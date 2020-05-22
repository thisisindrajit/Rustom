<?php

session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="customer")) //user not logged in or user logged in is a customer
{
    header('location:index.php');
}

include("dbconnect.php");

$dealerid = $_SESSION['userid']; //getting the dealer id
$dealername = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $dealername."'s " ?> Sales - Rustom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="icon.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<style>

.card{
    margin-bottom:10px;
    margin-top:15px;
}

.card-img-top
{
    min-height:250px;
    max-height:250px;
    object-fit:cover;
}

#listicon
{
    position:absolute;
    left:20px;
    margin-top:1px;
    cursor:pointer;
}


#title
{
    font-family: 'Open Sans', sans-serif;
    margin:auto;
    margin-bottom:0.5px;
    text-align:center;   
    font-weight:300;
    font-size:1.5rem;
}

#header #logout
{
    position:absolute;
    right:20px;
    cursor:pointer;
}

#list
{
    position:fixed;
    top:0;
    height:100%;
    z-index:20;
    left:0;
    background-color:#C39BD3;
    width:0;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    transition:width 0.15s ease-in-out;
}

#list a
{
    font-weight:350;
    text-align:center;
    color:white;
    font-size:1.5rem;
    margin:5px 0;
    transition:color 0.15s ease-in-out;
}

#list #active
{
    cursor:default;
    color:#76448A;
}

#list a:hover
{
    color:#76448A;
    text-decoration:none;
}

#list #closelist
{
    cursor:pointer;
    background-color:#76448A;
    width:fit-content;
    position:absolute;
    top:10px;
    padding:5px;
    display:flex;
    align-items:center;
    right:10px;
}

.row
{
    align-items:flex-start;
}

li
{
    text-align:left;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    margin-bottom:1px;
    max-width:100%;
}

.card-subtitle
{
    color:#884EA0;
}

@media screen and (max-width:1000px)
{

#carname
{
  font-size:40px;
}

}


@media screen and (max-width:1200px)
{
    .row
    {
        flex-direction:row;
        min-width:80%;
    }

    .col-sm-3 
    {
    min-width:50%;
    }
}

@media screen and (max-width:769px)
{
    .row
    {
        justify-content:center;
    }

    .col-sm-3 
    {
    min-width:80%;
    }

    #explore
    {
        text-align:center;
        padding:20px 0;
        border-bottom:1px solid #C39BD3;
    }
}

</style>

<body>

<div id="list">
<div id="closelist" onclick="openlist()">
<svg class="bi bi-chevron-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 010 .708L5.707 8l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"/>
</svg>
</div>

<a href="dealer_index.php">Home</a>
<a href="dealer_profile.php">Profile</a>
<a id="active">Cars Sold</a>
<a href="dealer_rented.php">Cars Rented</a>

</div>

<div class="container-fluid text-white py-3" id="header" style="background-color:black;position:fixed;z-index:5;top:0;display:flex;align-items:center">

<div id="listicon" onclick="openlist()">
<svg class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>
</div>

<a id="logout" href="logout.php">
<svg class="bi bi-x-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
</svg>
</a>

<!--<h3 id="title">Rustom</h3>-->

<img src="logow.png" height="50px" style="margin:auto">

</div>

<div class="container" style="width:80%;margin:auto;margin-top:135px">
<h2 id="carname" class="display-4 text-center">Sold Cars</h2>

</div>

<div class="container-fluid py-3" style="width:80%">

<h3 id="explore" style="font-weight:lighter">New Cars</h3>

<div class="row">

<?php 

$soldcarsquery = "
select customername,car.carid as carid,name,DATE_FORMAT(paymentdate,'%d %M %Y') as paymentdate from owns 
inner join customer inner join car inner join newcar where car.carid=newcar.newcarid and dealerid = $dealerid and 
paymentstatus='verified' and customer.customerid = newcar.customerid and car.carid=owns.carid order by paymentdate desc";
$ex = mysqli_query($conn,$soldcarsquery);

if(mysqli_num_rows($ex)===0)
{
?>

<div style="width:100%;border:1px solid #C39BD3;margin-top:15px;padding:10px 0;text-align:center;font-size:1.2rem;font-weight:lighter;color:black">No new cars sold yet!</div>

<?php
}

while($row=mysqli_fetch_assoc($ex))
{

?>

<div class="col-sm-3">
    
<div class="card">
<div class="card-body">
<h5 class="card-title"><?php echo $row["name"] ?></h5>
<h6 class="card-subtitle mb-2">Sold on <?php echo $row["paymentdate"]." to ".$row["customername"]?></h6>
<hr>
<a href="<?php echo "newcar.php?carid=".$row["carid"]?>" class="card-link">Car Details</a>
</div>
</div>
</div>

<?php 

}
?>

</div>

<h3 id="explore" style="font-weight:lighter;margin-top:50px">Resale Cars</h3>

<div class="row">


<?php
$soldresalecarsquery = "
select customername,car.carid as carid,name,DATE_FORMAT(paymentdate,'%d %M %Y') as paymentdate from owns 
inner join customer inner join car inner join preownedcar where car.carid=preownedcar.preownedcarid and dealerid = $dealerid and 
paymentstatus='verified' and customer.customerid = preownedcar.customerid and car.carid=owns.carid order by paymentdate desc";

$ex2 = mysqli_query($conn,$soldresalecarsquery);

if(mysqli_num_rows($ex2)===0)
{
?>


<div style="width:100%;border:1px solid #C39BD3;margin-top:15px;padding:10px 0;text-align:center;font-size:1.2rem;font-weight:300;color:black">No resale cars sold yet!</div>

<?php    
}

while($row=mysqli_fetch_assoc($ex2))
{

?>

<div class="col-sm-3">
    
<div class="card">
<div class="card-body">
<h5 class="card-title"><?php echo $row["name"] ?></h5>
<h6 class="card-subtitle mb-2">Sold on <?php echo $row["paymentdate"]." to ".$row["customername"]?></h6>
<hr>
<a href="<?php echo "resalecar.php?carid=".$row["carid"]?>" class="card-link">Car Details</a>
</div>
</div>
</div>

<?php } ?>

</div>




</body>

<script type="text/javascript" src="JS/list.js"></script>

</html>