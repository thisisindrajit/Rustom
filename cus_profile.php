<?php

session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="dealer")) //user not logged in or user logged in is a dealer
{
    header('location:index.php');
}

include("dbconnect.php");

$cusid = $_SESSION['userid']; //getting the customer id
$cusname = $_SESSION['username'];
$query = "SELECT * FROM customer WHERE customerid = $cusid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>


<head>
  <title><?php echo $cusname."'s " ?> Profile - Rustom</title>
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

#alert
{
    display:none;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}
@media only screen and (max-width:650px)
{
    .modal-content {
    width: 100%;
    }   
}
/* The Close Button */
.close {
  color: #aaaaaa;
  text-align: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

#wrongpass
{
    display: none;
}

#password_match
{
    display: none;
}

#password_successful
{
    display: none;
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
    
    <a href="cus_index.php">Home</a>
    <a id="active">Profile</a>
    <a href="cus_purchased.php">My Purchases</a>
    <a href="cus_rented.php">Rented cars</a>
    
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

<div class="container bootstrap snippet" style="width:80%;margin:auto;margin-top:135px;margin-bottom:60px">
    <div class="row" style="padding:20px 0;border-bottom:1px solid #C39BD3">
  		<h1 class="display-4" style="font-size:40px">My Profile</h1>
    	<!--<div class="col-sm-2"><img title="profile image" height="60px" class="img-circle img-responsive" src="logo.jpg" alt = "Rustom Logo" ></div>-->
    </div>
    <div class="row">
  		<div class="col-sm-3" style="margin-top:25px"><!--left col-->
              

      <div class="text-center container-fluid">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar" style="margin-bottom:10px">
      <!--<h6>Upload a different photo</h6>
        <input type="file" class="center-block file-upload" style="width:95px">-->
      </div><br>

          
        </div><!--/col-3-->
    	<div class="col-sm-9">
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <form class="form" method="post" id="update">
                    <div class="form-group">
                        <Br>
                        <div class="col-xs-6">
                            <label for="name"><h4>Name</h4></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $cusname ?>" title="enter your name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="dob"><h4>Date of Birth</h4></label>
                            <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $row['DOB'] ?>"  title="enter your DOB">
                        </div>
                    </div>
                
                    <div class="form-group">
                        
                        <div class="col-xs-6">
                            <label for="phone"><h4>Phone</h4></label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $row['PhoneNo'] ?>" title="enter your phone number if any">
                        </div>
                    </div>
        
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="address"><h4>Address</h4></label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $row['Address'] ?>" title="enter your address">
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-xs-6">
                            <label for="dlno"><h4>Driving License Number</h4></label>
                            <input type="text" class="form-control" name="dlno" id="dlno" placeholder="Driving License Number" value="<?php echo $row['DrivingLicense'] ?>" title="enter your driving license number">
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $row['C_Email'] ?>" title="enter your email" readonly>
                        </div>
                    </div>
                
                    <!--<div class="form-group">
                        
                        <div class="col-xs-6">
                            <label for="password"><h4>Password</h4></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" title="enter your password">
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-xs-6">
                        <label for="password2"><h4>Verify Password</h4></label>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Verify password" title="re-enter your password">
                        </div>
                    </div>-->
                    <div style="margin-top:25px">
                        <a href="javascript: void(0)" onclick = "changePassword();">Change Password</a>
                    </div>    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" type="submit" id="submit" name="submit" onclick="update()"><i class="glyphicon glyphicon-ok-sign">Save</i></button>
                            <button class="btn btn-lg" onclick = "window.location.reload();"><i class="glyphicon glyphicon-repeat" color = "513450">Reset</i></button>
                        </div>
                    </div>
                </form>
                <div id="alert" class="alert alert-info" role="alert">  
                    <!--Displays the alert message after updation-->               
                </div>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    <div id="change_password" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Change Password</h3>
            <hr width="100%" style="background-color:#C39BD3;border:none;height:1px">
            <form id="password_form" method="post">
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="currentpassword"><h4>Current Password</h4></label>
                    <input type="password" class="form-control" name="currentpassword" id="currentpassword" placeholder="Current Password" required>
                </div>
            </div>
            <div id="wrongpass" class="alert alert-info" role="alert">  
                    <!--Displays the alert message if password is wrong-->               
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="newpassword"><h4>New Password</h4></label>
                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" onchange="confirmPassword();" required minlength="8">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="confirmpassword"><h4>Confirm Password</h4></label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" onchange="confirmPassword();" required minlength="8">
                </div>
            </div>
            <div id="password_match" class="alert alert-info" role="alert">  
                    <!--Displays the alert message if password doesn't match-->               
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <br>
                    <button class="btn btn-lg btn-success" type="submit" name="changepass"><i class="glyphicon glyphicon-ok-sign">Change Password</i></button>
                </div>
            </div>
            </form>
            <div id="password_successful" class="alert alert-info" role="alert">  
                    <!--Displays the alert message if password doesn't match-->               
            </div>
        </div>
    </div>
    </body>

<script>
    $(document).ready(function() {
        //Date validation
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 18;
    if(month < 10)
    month = '0' + month.toString();
    if(day < 10)
    day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#dob').attr('max', maxDate);
    
    //for file upload
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
    

    $("#update").submit(function(event){
        event.preventDefault(); // avoid to execute the actual submit of the form.
        var formdata = {
            'name' : $('#name').val(),
            'dob' : $('#dob').val(),
            'phone' : $('#phone').val(),
            'address' : $('#address').val(),
            'dlno' : $('#dlno').val()
        };
        var url = "cus_update.php";
        $.ajax({
            type: "POST",
            url: url,
            data: formdata, 
            success: function(data)
            {
                $("#alert").empty();
                $("#alert").append('<p class=card-text>' +data+ '</p>');
                $("#alert").css("display","block");               
                if(data == "No changes made!")
                {
                    $("#alert").css("background-color","rgba(255, 0, 0, 0.1)"); 
                    $("#alert").css("color","#ff0000"); 
                }
                else
                {
                    $("#alert").css("background-color","rgba(0, 255, 0, 0.1)"); 
                    $("#alert").css("color","#00cc00");
                }
            }
            });
    });

    // Get the modal
    var modal = document.getElementById("change_password");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    function changePassword()
    {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }
    
    function updatePassword()
    {
        $.ajax({
            type: "POST",
            url: "update_password.php",
            data: {password : $("#confirmpassword").val()}, 
            success: function(data)
            {
                $("#password_form").css("display","none");
                $("#password_successful").empty();
                $("#password_successful").append('<p class=card-text>' +data+ '</p>');
                $("#password_successful").css("display","block");
                $("#password_successful").css("background-color","rgba(0, 255, 0, 0.1)"); 
                $("#password_successful").css("color","#00cc00");               
                // show response from the php script.
            }
            });
    }

    $("#change_password").submit(function(event){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "validate_password.php",
            data: {password : $("#currentpassword").val()}, 
            success: function(data)
            {
                $("#wrongpass").empty();
                $("#wrongpass").append('<p class=card-text>' +data+ '</p>');
                $("#wrongpass").css("display","block");
                if(data == "Invalid Password!")
                {
                    $("#wrongpass").css("background-color","rgba(255, 0, 0, 0.1)"); 
                    $("#wrongpass").css("color","#ff0000"); 
                }
                else
                {
                    $("#wrongpass").css("background-color","rgba(0, 255, 0, 0.1)"); 
                    $("#wrongpass").css("color","#00cc00");
                    //checking if the passwords match
                    if(confirmPassword())
                    {   
                        updatePassword();       
                    }
                }          
            }
            });
        });

    function confirmPassword()
    {
        var newpass = $("#newpassword").val();
        var confirmpass = $("#confirmpassword").val();
        var currentpass = $("#currentpassword").val();

        if(newpass == currentpass || confirmpass == currentpass)
        {
            $("#password_match").empty();
            $("#password_match").append('<p class=card-text>Old and New passwords are same!</p>');
            $("#password_match").css("display","block");
            $("#password_match").css("background-color","rgba(255, 0, 0, 0.1)"); 
            $("#password_match").css("color","#ff0000");
            return 0;
        }
        else if(newpass != confirmpass)
        {
            $("#password_match").empty();
            $("#password_match").append('<p class=card-text>Passwords do not match!</p>');
            $("#password_match").css("display","block");
            $("#password_match").css("background-color","rgba(255, 0, 0, 0.1)"); 
            $("#password_match").css("color","#ff0000");
            return 0;
        }
        else
        {
            $("#password_match").empty();
            $("#password_match").append('<p class=card-text>Passwords match!</p>');
            $("#password_match").css("display","block");
            $("#password_match").css("background-color","rgba(0, 255, 0, 0.1)"); 
            $("#password_match").css("color","#00cc00");
            return 1;
        }
    }
</script>

<script type="text/javascript" src="JS/list.js"></script>

</html>