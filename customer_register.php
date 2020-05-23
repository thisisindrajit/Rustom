<?php
if(isset($_POST["customerRegister"]))
{

include("dbconnect.php");

//Prepared statement to prevent SQL injection
$customer_insert= "INSERT INTO CUSTOMER (CustomerName, DOB, PhoneNo, Address, DrivingLicense, C_Email) VALUES (?,?,?,?,?,?)";
//set parameters
$c_name = mysqli_real_escape_string($conn, $_REQUEST['C_name']);
$c_dob = mysqli_real_escape_string($conn, $_REQUEST['C_DOB']);
$c_phoneno =  mysqli_real_escape_string($conn, $_REQUEST['C_phoneNo']);
$c_address =  mysqli_real_escape_string($conn, $_REQUEST['C_address']);
$c_drivingLicense =  mysqli_real_escape_string($conn, $_REQUEST['C_drivingLicense']);
$c_email = mysqli_real_escape_string($conn, $_REQUEST['C_email']);
$c_password = mysqli_real_escape_string($conn, $_REQUEST['C_password']);

if($stmt= mysqli_prepare($conn, $customer_insert) )
{
    //Bind the variables to prepared statements as parameters
     mysqli_stmt_bind_param($stmt, "ssssss", $c_name,  $c_dob, $c_phoneno, $c_address, $c_drivingLicense, $c_email);
   
    //Execute the statement
    if(mysqli_stmt_execute($stmt))
    {
        echo "Inserted successfully";
    }
    else
    {
        echo "Error: Could not execute the query: " . mysqli_error($conn);
        header("Location: error.php");
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
    header("Location: error.php");
}

$customer_login = "INSERT INTO CUSTOMER_LOGIN (C_Email, Password, vkey) VALUES (?, ?, ?)";
$vkey = md5(time().$c_name);

if($stmt = mysqli_prepare($conn, $customer_login))
{
    mysqli_stmt_bind_param($stmt, "sss", $c_email, $c_password, $vkey); 
      
    if(mysqli_stmt_execute($stmt))
    {
        echo "Login insertion successful";
        //Sending verification email
        $subject = "Rustom Email Verification";
        $message = "Hello $c_name, you are one step away from Rustoming! <a href= 'https://localhost/CARS/verify.php?vkey=$vkey'>Click Here</a> to verify your email address and activate your account!";
        $headers = "From: thisisourprojectx@gmail.com" . "\r\n";
        // Always set content-type when sending HTML email
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        if(mail($c_email,$subject,$message,$headers))
        {
            header("Location: thankyou.php");
        }
        else
        {
            header("Location: error.php");
        }

        /*$login_time = "UPDATE CUSTOMER_LOGIN SET lastloggedintime = CURRENT_TIMESTAMP() WHERE C_Email = '$c_email'" ;
        $retval = mysqli_query($conn, $login_time);

        $get_cus_id = "SELECT customerid FROM Customer where customername='$c_name'";
        $result =  mysqli_query($conn, $get_cus_id);
        $resfet = mysqli_fetch_assoc($result);

        $cusid = $resfet["customerid"];

        
        if($retval)
        {
            //echo "Updated Successfully";
            session_start();

            $info_query = "SELECT customerID FROM customer where c_email = '$c_email'";
            $info_result = mysqli_query($conn, $info_query);
            $info = mysqli_fetch_array($info_result, MYSQLI_ASSOC);
        
        //storing the necessary information in session
            $_SESSION['userid'] = $info['customerID'];
            $_SESSION['username'] = $c_name;       
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = 'customer';
            $_SESSION['logged_in'] = true;
            
            header("Location: cus_index.php"); //moving in to customer dashboard
        }
        else
        {
            echo "Error: Could not update: ". mysqli_error($conn);
            header("Location: error.php");
        }*/
    }
    else
    {
        echo "Error: Could not execute the query: " . mysqli_error($conn);
        header("Location: error.php");
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
    header("Location: error.php");
} 
}
else
{
    header("location: register.html");
}
?>

