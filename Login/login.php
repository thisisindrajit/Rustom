<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include('../dbconnect.php');
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $customer_query = "SELECT * FROM customer_login WHERE c_email= '$email' AND password = '$password'";
    $customer_result = mysqli_query($conn, $customer_query);
    $row = mysqli_fetch_array($customer_result, MYSQLI_ASSOC);

    if(mysqli_num_rows($customer_result) == 1)
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
            header("location: ../index.php");
        }
    }
    else
    {
        $dealer_query = "SELECT * FROM dealer_login WHERE d_email= '$email' AND password = '$password'";
        $dealer_result = mysqli_query($conn, $dealer_query);
        $row = mysqli_fetch_array($dealer_result, MYSQLI_ASSOC);
    
        if(mysqli_num_rows($dealer_result) == 1)
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
                header("location: ../index.php");
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
<title>Rustom - Login</title>
<link rel="icon" href="../logo.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
 <!--Google Fonts-->
 <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<head>
<style>

</style>
<body>
<div class= "container-fluid">
<form id="login" action="" method="post">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Login</button>
</form>
</div>

</body>
</html>