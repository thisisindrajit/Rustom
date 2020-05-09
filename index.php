<!DOCTYPE html>
<html>
<head>
    <title>Rustom - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="logo.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
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
}

#person
{
    position:absolute;
    right:20px;
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

<script type="text/javascript" src="JS/home.js"></script>

<body onload="getcardetails()">

<div class="container-fluid text-white py-3" style="background-color:black;position:fixed;z-index:5;top:0;display:flex;align-items:center">

<svg id="listicon" class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>


<svg id="person" class="bi bi-person-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
</svg>

<!--<h3 id="title">Rustom</h3>-->

<img src="logow.png" height="50px" style="margin:auto">

</div>

<div class="input-group mb-3" style="width:80%;margin:auto;margin-top:135px">
  <span class="input-group-text" id="basic-addon1" style="position:relative;margin-right:0;background-color:#C39BD3;border:none;border-radius:0">
  
  <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
  </svg>
    
  </span>
  <input type="text" id="query" class="form-control shadow-none" placeholder="Search for Cars..." onkeyup="searchcars()" style="border-color:#C39BD3;border-radius:0;border-left:none">
</div>


<div class="searchbox container-fluid py-3">

</div>

</div>

<div class="container-fluid py-3" style="width:80%">

<h3 id="explore" style="font-weight:lighter">Explore</h3>

<div class="row">

</div>

</body>
</html>
