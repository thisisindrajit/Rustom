<?php
session_start();
include("dbconnect.php");

$dealerid = $_SESSION['userid']; //getting the dealer id
$dealername = $_SESSION['username'];
$query = "SELECT * FROM dealer WHERE dealerid = $dealerid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$dealer_update= "UPDATE dealer SET DName=?, PhoneNo=?, Website=? WHERE dealerid = $dealerid";

if($stmt= mysqli_prepare($conn, $dealer_update) )
{
    //Bind the variables to prepared statements as parameters
    mysqli_stmt_bind_param($stmt, "sss", $d_name, $d_phoneno, $d_website);

    //set parameters
    $d_name = mysqli_real_escape_string($conn, $_POST['name']);
    $d_phoneno =  mysqli_real_escape_string($conn, $_POST['phone']);
    $d_website =  mysqli_real_escape_string($conn, $_POST['website']);
    
    //Execute the statement
    if($row['DName'] != $d_name || $row['PhoneNo'] != $d_phoneno || $row['Website'] != $d_website)
    {   
        if(mysqli_stmt_execute($stmt))
        {
            $_SESSION['username'] = $d_name;
            echo "Updated Successfully!";
        }
        else
        {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
        }
    }
    else
    {
        echo "No changes made!";
    }        
}
?>