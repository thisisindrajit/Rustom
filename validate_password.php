<?php
session_start();
include("dbconnect.php");

$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
$usertype = $_SESSION['usertype'];
$password = mysqli_real_escape_string($conn, $_POST['password']);

if($usertype === "customer")
{
    $query = "SELECT password FROM customer_login WHERE c_email = '$email'";
    $result = mysqli_query($conn, $query);
    $row =mysqli_fetch_assoc($result);
    if($password === $row['password'])
    {
        echo "Password Verified!";
    }
    else
    {
        echo "Invalid Password!";
    }
}
else
{
    $query = "SELECT password FROM dealer_login WHERE d_email = '$email'";
    $result = mysqli_query($conn, $query);
    $row =mysqli_fetch_assoc($result);
    if($password === $row['password'])
    {
        echo "Password Verified!";
    }
    else
    {
        echo "Invalid Password!";
    }
}
?>