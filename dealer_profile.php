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
  <title><?php echo $dealername."'s " ?> Profile - Rustom</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="icon.ico">


  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="dealer_profile.css" rel = "stylesheet">
</head>

<style>
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

h4
{
    font-size:16px;
}


</style>

<script>

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>

<body>

    <div id="list">
    <div id="closelist" onclick="openlist()">
    <svg class="bi bi-chevron-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 010 .708L5.707 8l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"/>
    </svg>
    </div>
    
    <a href="dealer_index.php">Home</a>
    <a id="active">Profile</a>
    <a href="dealer_sold.php">Cars Sold</a>
    <a href="#">Cars Rented</a>
    
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

<div class="container bootstrap snippet" style="width:80%;margin:auto;margin-top:135px">
    <div class="row" style="padding:20px 0;border-bottom:1px solid #C39BD3">
  		<h1 class="display-4" style="font-size:40px">My Profile</h1>
    	<!--<div class="col-sm-2"><img title="profile image" height="60px" class="img-circle img-responsive" src="logo.jpg" alt = "Rustom Logo" ></div>-->
    </div>
    <div class="row">
  		<div class="col-sm-3" style="margin-top:25px"><!--left col-->
              

      <div class="text-center container-fluid">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="margin-bottom:10px">
      <h6>Upload a different photo</h6>
        <input type="file" class="center-block file-upload" style="width:95px">
      </div><br>

          
        </div><!--/col-3-->
    	<div class="col-sm-9">
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          <Br>
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="name" placeholder="Name" title="enter your name">
                          </div>
                      </div>
                    
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" title="enter your phone number if any">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="text"><h4>Website</h4></label>
                              <input type="text" class="form-control" name="website" id="website" placeholder="Website" title="enter your website if any">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" title="enter your email">
                          </div>
                      </div>
                    
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" title="enter your password">
                          </div>
                      </div>
                      <!--<div class="form-group">
                          
                          <!--<div class="col-xs-6">
                            <label for="password2"><h4>Verify Password</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="Verify password" title="re-enter your password">
                          </div>
                      </div>-->
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat" color = "513450"></i> Reset</button>
                            </div>
                      </div>
              	</form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->

    </body>
        
       <script>
        $(document).ready(function() {


var readURL = function(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('.avatar').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}


$(".file-upload").on('change', function(){
  readURL(this);
});
});
        </script>

        <script type="text/javascript" src="JS/list.js"></script>

</html>