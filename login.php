<?php

//if($_SERVER["REQUEST_METHOD"] == "POST")

if(isset($_POST["submit"]))
{
    include('dbconnect.php');

    session_start();

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $customer_query = "SELECT * FROM customer_login WHERE c_email= '$email' AND password = '$password'";
    $customer_result = mysqli_query($conn, $customer_query);
    $row = mysqli_fetch_array($customer_result, MYSQLI_ASSOC);

    if(mysqli_num_rows($customer_result) == 1)
    {
        if($row['verified'] == 1)
        {
            $info_query = "SELECT customerID, customerName FROM customer where c_email = '$email'";
            $info_result = mysqli_query($conn, $info_query);
            $info = mysqli_fetch_array($info_result, MYSQLI_ASSOC);
            
            //storing the necessary information in session
            $_SESSION['userid'] = $info['customerID'];
            $_SESSION['username'] = $info['customerName'];       
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = 'customer';
            $_SESSION['logged_in'] = true;

            $update = "UPDATE customer_login SET lastloggedintime = CURRENT_TIME() WHERE c_email= '$email' AND password = '$password'";
            $result = mysqli_query($conn, $update);
            if($result)
            {
                header("location: cus_index.php");
            }
            else
            {
                header("Location: error.php");
            }
        }
        else
        {
            echo "<script> alert(\"Your account has not been verified yet! A verification email has already been sent to $email. Please acknowledge it in order to activate your account! Happy Rustoming!\")</script>";
        }
    }
    else
    {
        $dealer_query = "SELECT * FROM dealer_login WHERE d_email= '$email' AND password = '$password'";
        $dealer_result = mysqli_query($conn, $dealer_query);
        $row = mysqli_fetch_array($dealer_result, MYSQLI_ASSOC);
    
        if(mysqli_num_rows($dealer_result) == 1)
        {
            if($row['verified'] == 1)
            {
                $info_query = "SELECT dealerID, dname FROM dealer where d_email = '$email'";
                $info_result = mysqli_query($conn, $info_query);
                $info = mysqli_fetch_array($info_result, MYSQLI_ASSOC);
            
                //storing the necessary information in session
                $_SESSION['userid'] = $info['dealerID'];
                $_SESSION['username'] = $info['dname'];       
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = 'dealer';
                $_SESSION['logged_in'] = true;

                $update = "UPDATE dealer_login SET lastloggedintime = CURRENT_TIME() WHERE d_email= '$email' AND password = '$password'";
                $result = mysqli_query($conn, $update);
                if($result)
                {
                    header("location: dealer_index.php"); 
                }
                else
                {
                    header("Location: error.php");
                }
            }
            else
            {
                echo "<script> alert(\"Your account has not been verified yet! A verification email has already been sent to $email. Please acknowledge it in order to activate your account! Happy Rustoming!\")</script>";
            }

        }
        
        else
        {
            echo "<script> alert(\"Invalid email or password\")</script>";
        }   
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Rustom</title>
<link rel="icon" href="icon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
 <!--Google Fonts-->
 <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<head>
<style>
body,html
{
    height: 100%;
    width:100%;
    font-family: 'Titillium Web', sans-serif;
    font-size:1.1rem;
}

body{
    background-image: url('mclaren.jpg');
    height: 100%;
    width:100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment:fixed;
}
.container
{
    border-radius:5px;
    height: fit-content;
    width: 35%;
    z-index:1;
    top: 50%;
    left:50%;
    position: absolute;
    transform: translate(-50%, -50%);
    background-color: rgba(0,0,0,0.8);
}
.main-logo
{
    width: 100%;
    text-align: center;
    padding-top:20px;
    color: white;
}
#logo
{
    background-color: transparent;
    width:115px;
    border-radius:50%;
}
.main-header
{
    color: #333;
    font-size: 30px;
    font-weight: 300;
    text-align: center;
    text-shadow: none;
    color: white;
    padding: 10px;

}
.main
{
    font-size: 16px;
    font-weight: 600;
    margin:20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #d8dee2;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.19), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.btn-primary
{
    width: 100%;
}
@media only screen and (max-width: 800px) {
    .container
    {
        min-width: 90%;
    }
}

@media only screen and (max-width: 1200px) {
    .container
    {
        width: 50%;
    }
}
</style>
<body>
<div class = "bg"></div>
<div class="container">
<div class="main-logo"> <img id="logo" height='90px' src="logow.png" > </div>

<div class="main-header"> Login to Rustom </div>

<div class= "main">
<form id="login" action="" method="post">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required >
    </div>
    <div style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Login</button></div>
</form>
</div>

<div class="main" style="text-align: center;">
    New to Rustom? <a href="register.html">Register here</a>
</div>
</div>
</body>
</html>