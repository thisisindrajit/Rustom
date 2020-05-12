<?php

$servername="localhost";
$database="cars";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    /*die("Connection error: " . mysqli_connect_errno());*/
    header("Location: ../error.php");
}


//Prepared statement to prevent SQL injection
$customer_insert= "INSERT INTO CUSTOMER (CustomerName, DOB, PhoneNo, Address, DrivingLicense, C_Email) VALUES (?,?,?,?,?,?)";

$c_email = mysqli_real_escape_string($conn, $_REQUEST['C_email']);
if($stmt= mysqli_prepare($conn, $customer_insert) )
{
    //Bind the variables to prepared statements as parameters
     mysqli_stmt_bind_param($stmt, "ssssss", $c_name,  $c_dob, $c_phoneno, $c_address, $c_drivingLicense, $c_email);

    //set parameters
    $c_name = mysqli_real_escape_string($conn, $_REQUEST['C_name']);
    $c_dob = mysqli_real_escape_string($conn, $_REQUEST['C_DOB']);
    $c_phoneno =  mysqli_real_escape_string($conn, $_REQUEST['C_phoneNo']);
    $c_address =  mysqli_real_escape_string($conn, $_REQUEST['C_address']);
    $c_drivingLicense =  mysqli_real_escape_string($conn, $_REQUEST['C_drivingLicense']);
    
    //Execute the statement
    if(mysqli_stmt_execute($stmt))
    {
        echo "Inserted successfully";
    }
    else
    {
        echo "Error: Could not execute the query: " . mysqli_error($conn);
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
}

$customer_login = "INSERT INTO CUSTOMER_LOGIN (C_Email, Password) VALUES (?, ?)";

if($stmt = mysqli_prepare($conn, $customer_login))
{
    mysqli_stmt_bind_param($stmt, "ss", $c_email, $c_password); 
    $c_password = mysqli_real_escape_string($conn, $_REQUEST['C_password']);
      
    if(mysqli_stmt_execute($stmt))
    {
        echo "Login insertion successful";
        
        $login_time = "UPDATE CUSTOMER_LOGIN SET lastloggedintime = CURRENT_TIMESTAMP() WHERE C_Email = '" . $c_email . "'" ;
        $retval = mysqli_query($conn, $login_time);

        $get_cus_id = "SELECT customerid FROM Customer where customername='$c_name'";
        $result =  mysqli_query($conn, $get_cus_id);
        $resfet = mysqli_fetch_assoc($result);

        $cusid = $resfet["customerid"];

        
        if($retval)
        {
            echo "Update Successfully";
            header("Location: ../Customer/index.php?cusid=".$cusid); //moving in to customer dashboard
        }
        else
        {
            echo "Error: Could not update: ". mysqli_error($conn);
        }
    }
    else
    {
        echo "Error: Could not execute the query: " . mysqli_error($conn);
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
} 
?>

