<?php

session_start();

if(!isset($_SESSION['logged_in'])) //user not logged in
{
    header('location:index.php');
}

include("dbconnect.php");

$carid = $_REQUEST["carid"];
$userid = $_SESSION['userid'];
$usertype =  $_SESSION['usertype'];

//first query to select all car and its dealer details
$query1 = "select Name,Dname,Mname,status,manufacturer.phoneno as mph,manufacturer.location as mloc,manufacturer.email as memail,manufacturer.website as mweb,dealer.phoneno as dph,d_email,
dealer.website as dweb,mileage,color,status,fueltype,licenseplateno,resaleprice,kmdriven,discount,customerid from car inner join preownedcar inner join manufacturer inner join owns inner join dealer where car.manufacturerid=manufacturer.manufacturerid and 
owns.carid=car.carid and owns.dealerid=dealer.dealerid and car.carid=preownedcar.preownedcarid and car.carid=$carid";

$result1 = mysqli_query($conn,$query1);
$firstquery = mysqli_fetch_assoc($result1);

//second query to get the features of the car
$query2 = "select features from features where carid=$carid";

$result2 = mysqli_query($conn,$query2);

//third query to get the images of the car
$query3 = "select images from images where carid=$carid";

$result3 = mysqli_query($conn,$query3);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $firstquery["Name"]?> - Rustom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="icon.ico">
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


#header #logout
{
    position:absolute;
    right:20px;
    cursor:pointer;
}

#content
{
    width:80%;
    margin:auto;
}

.image
{
  height:475px;
  margin:0.5% 0.5%;
  width:49%;
  object-fit:cover;
  overflow:hidden;
}

.image img
{
  height:475px;
}

#overlay {
  position: fixed;
  display:flex;
  flex-direction:column;
  align-items: center;
  justify-content:center;
  height:100%;
  opacity:0;
  margin-top:50px;
  width:100%;
  top:0;
  background-color:black;
  z-index:-1;
}

#modal
{
  height:475px;
  min-width:80%;
  max-width:80%;
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
}

#modal img {
  height:475px;
}


.tile {
    height:500px;
    min-width:60%;
    max-width:60%;
    overflow: hidden;
    display:flex;
    align-items:center;
    justify-content:center;
  }

  .photo {
    overflow:hidden;
    transition: transform .5s ease-in-out;
  }

  .photo img {
    height:500px;
  }

/*#close
{
  background-color:red;
  width:fit-content;
}*/



@media screen and (max-width:1000px)
{

#carname
{
  font-size:40px;
}

#modal,#modal img,.image,.image img
{
  height:350px;
}

}

@media screen and (max-width:600px)
{

#modal,#modal img,.image,.image img
{
  height:250px;
}

}

@media screen and (max-width:400px)
{

#modal,#modal img,.image,.image img
{
  height:175px;
}

}

@media screen and (max-width:1200px)
{

.image
{
  width:99%;
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

<?php if($usertype==="customer")
{
?>
<a href="cus_index.php">Home</a>
<a href="cus_profile.php">Profile</a>
<a href="cus_purchased.php">My Purchases</a>
<a href="cus_rented.php">Rented cars</a>

<?php }
else{
?>

<a href="dealer_index.php">Home</a>
<a href="dealer_profile.php">Profile</a>
<a href="dealer_sold.php">Cars Sold</a>
<a href="dealer_rented.php">Cars Rented</a>

<?php } ?>

</div>

<div id="overlay"></div>

<div class="container-fluid text-white py-3" id="header" style="background-color:black;position:fixed;z-index:5;top:0;display:flex;align-items:center">

<div id="listicon" onclick="openlist()">
<svg class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>
</div>


<a id="logout" href="logout.php">
<svg id="person" class="bi bi-x-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
</svg>
</a>

<img src="logow.png" onclick="gotodash(<?php echo '\''.$usertype.'\'' ?>)" height="50px" style="margin:auto;cursor:pointer">

</div>

<div class="jumbotron jumbotron-fluid" style="margin-top:80px">
  <div class="container">
    <h1 id="carname" class="display-4 text-center"><?php echo $firstquery["Name"] ?></h1>
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
    <p class="card-text"><b>Type - </b><?php echo "Resale Car"?></p>
    <p class="card-text"><b>Color - </b><?php echo $firstquery["color"]?></p>
    <p class="card-text"><b>Mileage - </b><?php echo $firstquery["mileage"]." km/l" ?></p>
    <p class="card-text"><b>Fuel Type - </b><?php echo $firstquery["fueltype"]?></p>
    
    <p class="card-text"><b>License plate no</b>
    
    <li class="list-group-item list-group-item-warning" style="text-align:center"><?php echo $firstquery["licenseplateno"]?></li>

    </p>

    <p class="card-text"><b>Kilometers driven - </b><?php echo $firstquery["kmdriven"]?></p>
    
    <?php if($firstquery["discount"]!==null){ 

$discount=$firstquery["discount"];
$disprice=floor(($discount/100)*$firstquery["resaleprice"]);
$newprice=$firstquery["resaleprice"]-$disprice;
?>

<div class="alert alert-info" role="alert">
<p class="card-text"><b>Discount - </b><?php echo $firstquery["discount"]."%"?></p>
<p class="card-text"><b>Price - </b><del><?php echo "Rs ".$firstquery["resaleprice"]?></del><?php echo " Rs ".$newprice." only!" ?></p>
</div>


<?php
}
else
{
?>

<p class="card-text"><b>Price - </b><?php echo "Rs ".$firstquery["resaleprice"]?></p>

<?php } ?>


<?php
if($usertype!=="dealer") //user type is not a dealer
{
if($firstquery["status"]==="available") //no user has bought the car yet
{
?>

<button type="button" class="btn btn-primary" onclick="buycar(<?php echo $carid.',\'resale\'' ?>)">Buy this car</button>
<!--<button type="button" class="btn btn-outline-info">Add to wishlist</button>-->
<?php
}
else if($firstquery["status"]==="sold out"&&$firstquery["customerid"]===$userid&&$usertype==="customer")
{
?>

  <div class="alert alert-success" role="alert" style="margin-bottom:0">
  Hooray! You bought this car!
  </div>

<?php  
}
else
{
?>

<div class="alert alert-danger" role="alert" style="margin-bottom:0">
Sorry but this car is sold out!
</div>


<?php 
}
} 
?>

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
  <ul class="list-group" style="margin-top:15px">
  
  <?php
    while($features=mysqli_fetch_assoc($result2))
    {
    ?>

  <li class="list-group-item">
  <h5 class="mb-1"><?php echo $features["features"]?></h5>
  <p class="mb-1">Detailed descripton of the feature will go here. (Feature coming soon!)</p>
  </li>

  <?php
    }
  ?>
  
  </ul>
  
  
  </div>

  <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
  
  <div class="container" style="min-width:100%;margin:15px 0">
  <div class="row">

  <?php

if(mysqli_num_rows($result3)===0)
{
?>

  No images to show! Please contact the dealer for more details!

<?php
  }

    while($images=mysqli_fetch_assoc($result3))
    {
    ?>
  
  <div class="image">
  <img src="<?php echo $images["images"]?>" alt="car_image" onclick="showimage(event)">
  </div>

  <?php
    }

    ?>

  </div>
  </div>
  
  
  </div>
</div>


</div>

</body>

<script type="text/javascript">

function gotodash(usertype)
{
    if(usertype==="customer")
    {
      window.location.href="cus_index.php";
    }

    else
    {
      window.location.href="dealer_index.php";
    }
   
}

$('#myTab a').on('click', function (e) {
  $(this).tab('show');
})

function showimage(event)
{
  $('#overlay').css('opacity','1');
  $('#overlay').css('z-index','5');


  if($( window ).width() >= 1000)
  {
  var div = '<div class="tile" data-scale="2"><div class="photo"><img src="'+event.target.src+'"></div></div>' + '<button type="button" id="close" class="btn btn-danger" style="margin-top:5px" onclick="closeimage()">Close</button>';

  $('#overlay').append(div);

$('.tile')
    // tile mouse actions
    .on('mouseover', function(){
      $(this).children('.photo').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
    })
    .on('mouseout', function(){
      $(this).children('.photo').css({'transform': 'scale(1)'});
    })
    .on('mousemove', function(e){
      $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    })

  }

  else
  {

    var div = '<div id="modal" style="opacity:1"><img src="'+event.target.src+'"></div>'+'<button type="button" id="close" class="btn btn-danger" style="margin-top:5px" onclick="closeimage()">Close</button>';
    $('#overlay').append(div);

  }
}

function closeimage()
{
  $('#overlay').css('opacity','0');
  $('#overlay').css('z-index','-1');

  if($( window ).width() >= 1000)
  {
  $('.tile').remove();
  $('.photo').remove();
  $('#close').remove();
  }

  else
  {
  $('#modal').remove();
  $('#close').remove();
  }
}

function buycar(carid,cartype)
{
  window.location.href="paymentredirect.php?carid="+carid+"&cartype="+cartype;
}

</script>
<script type="text/javascript" src="JS/list.js"></script>

</html>