<?php

session_start();
if(!isset($_SESSION['logged_in']))
{
    header('location: Login/login.php');
    /*include('dbconnect.php');
    $email_check = $_SESSION['email'];
    if($_SESSION['usertype'] == "customer")
    {
        $query = "SELECT * FROM customer_login WHERE c_email= '$email_check'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) === 0)
        {
            header('location: Login/login.php');
        }
    }
    else
    {
        $query = "SELECT * FROM dealer_login WHERE d_email= '$email_check'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) === 0)
        {
            header('location: Login/login.php');
        }
    }*/
}
?>

