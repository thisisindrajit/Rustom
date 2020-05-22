<?php
session_start();
include("dbconnect.php");

$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
$usertype = $_SESSION['usertype'];
$password = mysqli_real_escape_string($conn, $_POST['password']);

if($usertype === "customer")
{
    $update = "UPDATE customer_login SET password = ? WHERE c_email = ?";
    if($stmt= mysqli_prepare($conn, $update) )
    {
        //Bind the variables to prepared statements as parameters
        mysqli_stmt_bind_param($stmt, "ss", $password, $email);

        //Execute the statement
        if(mysqli_stmt_execute($stmt))
        {
            echo "Password Updated Successfully!";
        }
        else
        {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
            header('location: Login/login.php');
        } 
    }
    else
    {
        echo "Error: Could not prepare the query: " . mysqli_error($conn);
        header('location: Login/login.php');
    }
}
else
{
    $update = "UPDATE dealer_login SET password = ? WHERE d_email = ?";
    if($stmt= mysqli_prepare($conn, $update) )
    {
        //Bind the variables to prepared statements as parameters
        mysqli_stmt_bind_param($stmt, "ss", $password, $email);

        //Execute the statement
        if(mysqli_stmt_execute($stmt))
        {
            echo "Password Updated Successfully!";
        }
        else
        {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
            header('location: Login/login.php');
        } 
    }
    else
    {
        echo "Error: Could not prepare the query: " . mysqli_error($conn);
        header('location: Login/login.php');
    }
}
?>