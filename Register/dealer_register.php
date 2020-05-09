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
$dealer_insert= "INSERT INTO DEALER (DName, PhoneNo, Website, D_Email) VALUES (?,?,?,?)";

$d_email = mysqli_real_escape_string($conn, $_REQUEST['D_email']);
if($stmt= mysqli_prepare($conn, $dealer_insert) )
{
    //Bind the variables to prepared statements as parameters
     mysqli_stmt_bind_param($stmt, "ssss", $d_name, $d_phoneno, $d_website, $d_email);

    //set parameters
    $d_name = mysqli_real_escape_string($conn, $_REQUEST['D_name']);
    $d_phoneno =  mysqli_real_escape_string($conn, $_REQUEST['phone_no']);
    $d_website =  mysqli_real_escape_string($conn, $_REQUEST['website']);
    
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

$dealer_login = "INSERT INTO DEALER_LOGIN (D_Email, Password) VALUES (?, ?)";

if($stmt = mysqli_prepare($conn, $dealer_login))
{
    mysqli_stmt_bind_param($stmt, "ss", $d_email, $d_password); 
    $d_password = mysqli_real_escape_string($conn, $_REQUEST['D_password']);
      
    if(mysqli_stmt_execute($stmt))
    {
        echo "Login insertion successful";
        
        $login_time = "UPDATE DEALER_LOGIN SET lastloggedintime = CURRENT_TIMESTAMP() WHERE D_Email = '" . $d_email . "'" ;
        $retval = mysqli_query($conn, $login_time);
        if($retval)
        {
            echo "Update Successfully";
            header("Location: ../index.php");
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

