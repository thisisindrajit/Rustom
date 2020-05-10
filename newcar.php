<?php

include("dbconnect.php");

$carid = $_REQUEST["carid"];

//first query to select all car and its dealer details
$query1 = "select Name,Dname,Mname,manufacturer.phoneno as mph,manufacturer.location as mloc,manufacturer.email as memail,manufacturer.website as mweb,dealer.phoneno as dph,d_email,dealer.website as dweb,mileage,color,status,
fueltype,licenseplateno,Price from car inner join newcar inner join manufacturer inner join owns inner join dealer where car.manufacturerid=manufacturer.manufacturerid and 
owns.carid=car.carid and owns.dealerid=dealer.dealerid and car.carid=newcar.newcarid and car.carid=$carid";

$result1 = mysqli_query($conn,$query1);
$firstquery = mysqli_fetch_assoc($result1);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Rustom - <?php echo $firstquery["Name"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="logo.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<style>

#listicon
{
    position:absolute;
    left:20px;
    margin-top:1px;
}

#person
{
    position:absolute;
    right:20px;
}

#content
{
    width:80%;
    margin:auto;
}

</style>


<body>


<div class="container-fluid text-white py-3" style="background-color:black;position:fixed;z-index:5;top:0;display:flex;align-items:center">

<svg id="listicon" class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>


<svg id="person" class="bi bi-person-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
</svg>

<img src="logow.png" onclick="gotodash()" height="50px" style="margin:auto;cursor:pointer">

</div>

<div class="jumbotron jumbotron-fluid" style="margin-top:80px">
  <div class="container">
    <h1 class="display-4 text-center"><?php echo $firstquery["Name"] ?></h1>
    <p class="lead text-center">Dealer - <a href="#"><?php echo $firstquery["Dname"] ?></a></p>
  </div>
</div>

<div id="content">

<nav>
  <div class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
    <a class="nav-item nav-link" id="nav-features-tab" data-toggle="tab" href="#nav-features" role="tab" aria-controls="nav-features" aria-selected="false">Features</a>
    <a class="nav-item nav-link" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-gallery" aria-selected="false">Gallery</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
  
  <div class="card bg-light mb-3" style="margin-top:15px">

  <div class="card-header">Car Details</div>
  <div class="card-body">
    <p class="card-text"><b>Car Name - </b><?php echo $firstquery["Name"]?></p>
    <p class="card-text"><b>Manufacturer - </b><?php echo $firstquery["Mname"]?></p>
    <p class="card-text"><b>Color - </b><?php echo $firstquery["color"]?></p>
    <p class="card-text"><b>Mileage - </b><?php echo $firstquery["mileage"]." km/l" ?></p>
    <p class="card-text"><b>Fuel Type - </b><?php echo $firstquery["fueltype"]?></p>
    <p class="card-text"><b>Price - </b><?php echo "Rs ".$firstquery["Price"]?></p>
    <button type="button" class="btn btn-primary">Buy this car</button>
    <button type="button" class="btn btn-outline-info">Add to wishlist</button>

  </div>
  </div>


  <div class="card bg-light mb-3" style="margin-top:15px">
  <div class="card-header">Dealer Details</div>
  <div class="card-body">
    <p class="card-text"><b>Dealer Name - </b><?php echo $firstquery["Dname"]?></p>
    <p class="card-text"><b>Phone no - </b><?php echo $firstquery["dph"]?></p>
    <p class="card-text"><b>Email - </b><?php echo $firstquery["d_email"]?></p>
    <p class="card-text"><b>Website - </b><a href="<?php echo $firstquery["dweb"]?>" target="_blank"><?php echo $firstquery["dweb"]?></a></p>

  </div>

  </div>

  <div class="card bg-light mb-3" style="margin-top:15px">
  <div class="card-header">Manufacturer Details</div>
  <div class="card-body">
    <p class="card-text"><b>Manufacturer Name - </b><?php echo $firstquery["Mname"]?></p>
    <p class="card-text"><b>Phone no - </b><?php echo $firstquery["mph"]?></p>
    <p class="card-text"><b>Email - </b><?php echo $firstquery["memail"]?></p>
    <p class="card-text"><b>Website - </b><a href="<?php echo $firstquery["mweb"]?>" target="_blank"><?php echo $firstquery["mweb"]?></a></p>

  </div>

  </div>
  
  
  
  </div>
  
  
  <div class="tab-pane fade" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab">
  
  
  
  
  
  
  </div>
  <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
  
  
  
  
  
  
  
  
  
  
  </div>
</div>


</div>

</body>

<script type="text/javascript">

function gotodash()
{
    window.location.href="index.php";
}

$('#myTab a').on('click', function (e) {
  $(this).tab('show');
})


</script>

</html>