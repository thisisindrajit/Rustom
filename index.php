<?php


?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Dealership</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<style>

.searchbox
{
    display:block;
    width:80%;
    margin-top:50px;
    /*height:0;*/
    transform: scaleY(0);  
    transform-origin: top;
    transition:transform 0.15s linear;
}

.card{
    margin-bottom:10px;
}

#listicon
{
    position:absolute;
    margin-top:1.5px;
    left:20px;
}

#person
{
    position:absolute;
    margin-top:3.5px;
    right:20px;
}

#title
{
    margin:auto;
    margin-bottom:5px;
    text-align:center;   
    font-weight:lighter;
    font-size:1.6rem;
}

@media screen and (max-width:1000px)
{
    .row
    {
        align-items:center;
        flex-direction:row;
        min-width:80%;
    }

    .col-sm-3 
    {
    min-width:50%;
    }
}

</style>

<body>

<div class="container-fluid text-white py-3" style="background-color:black;position:fixed;z-index:5;top:0">

<svg id="listicon" class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>


<svg id="person" class="bi bi-person-fill" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
</svg>

<h3 id="title">EXYNOS</h3>

</div>

<div class="input-group mb-3" style="width:80%;margin:auto;margin-top:125px">
  <input type="text" id="query" class="form-control" placeholder="Search for Cars..." onkeyup="searchcars()">
</div>


<div class="searchbox container-fluid py-3">
</div>

<div class="container-fluid py-3" style="width:80%">

<h3 style="font-weight:lighter">Explore</h3>

<div class="row" style="margin-top:25px">

    <div class="col-sm-3">
    
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>



    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>




    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>



    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>
  
</div>





<div class="row" style="margin-top:1.5%">

    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>



    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>




    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>



    <div class="col-sm-3">
      
    <div class="card" style="padding:0px 0px 10px 0">
    
    <img src="dummy.png" class="card-img-top" alt="Car image">
    <div class="card-body">
    <h5 class="card-title">Car Name</h5>
    <h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
    <p class="card-text">Car Details go here...</p>
    <a href="#" class="card-link">More Details</a>
    </div>
    </div>

    </div>
  
</div>


</div>

<script type="text/javascript" src="JS/search.js"></script>

</body>
</html>
