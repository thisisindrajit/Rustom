<?php
if(isset($_POST["dealerRegister"]))
{

include("dbconnect.php");

//Prepared statement to prevent SQL injection
$dealer_insert= "INSERT INTO DEALER (DName, PhoneNo, Website, D_Email) VALUES (?,?,?,?)";
$d_name = mysqli_real_escape_string($conn, $_REQUEST['D_name']);
$d_phoneno =  mysqli_real_escape_string($conn, $_REQUEST['phone_no']);
$d_website =  mysqli_real_escape_string($conn, $_REQUEST['website']);
$d_email = mysqli_real_escape_string($conn, $_REQUEST['D_email']);
$d_password = mysqli_real_escape_string($conn, $_REQUEST['D_password']);

if($stmt= mysqli_prepare($conn, $dealer_insert) )
{
    //Bind the variables to prepared statements as parameters
     mysqli_stmt_bind_param($stmt, "ssss", $d_name, $d_phoneno, $d_website, $d_email);
  
    //Execute the statement
    if(mysqli_stmt_execute($stmt))
    {
        //echo "Inserted successfully";
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

//fetching userid
$info_query = "SELECT dealerID FROM dealer where d_email = '$d_email'";
$info_result = mysqli_query($conn, $info_query);
$info = mysqli_fetch_array($info_result, MYSQLI_ASSOC);
$dealerid = $info['dealerID'];

//inserting into branch
$branch_count = 1;
$branch = "";
$location = "";
if(isset($_POST['branch'.$branch_count.'']))
{
    $branch = mysqli_real_escape_string($conn,$_POST['branch'.$branch_count.'']);
}
if(isset($_POST['location'.$branch_count.'']))
{
    $location = mysqli_real_escape_string($conn,$_POST['location'.$branch_count.'']);
}
$branch_insert = "INSERT INTO branch VALUES (?,?,?)";
if($stmt = mysqli_prepare($conn, $branch_insert))
{
    while($branch !== '' && $location !== '')
    {
        mysqli_stmt_bind_param($stmt, "iss", $dealerid, $branch, $location);
        if(mysqli_stmt_execute($stmt))
        {
            echo "Branch $branch_count Inserted successfully";
            $branch_count++;
            $branch = "";
            $location = "";
            if(isset($_POST['branch'.$branch_count.'']))
            {
                $branch = mysqli_real_escape_string($conn,$_POST['branch'.$branch_count.'']);
            }
            if(isset($_POST['location'.$branch_count.'']))
            {
                $location = mysqli_real_escape_string($conn,$_POST['location'.$branch_count.'']);
            }
            if($branch === '' || $location === '')
            {
                $branch_count--;
            }
        }
        else
        {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
            header("Location: error.php");
        }
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
    header("Location: error.php");
}

//Inserting into dealer login
$dealer_login = "INSERT INTO DEALER_LOGIN (D_Email, Password, vkey) VALUES (?, ?, ?)";
$vkey = md5(time().$d_name);

if($stmt = mysqli_prepare($conn, $dealer_login))
{
    mysqli_stmt_bind_param($stmt, "sss", $d_email, $d_password, $vkey); 
      
    if(mysqli_stmt_execute($stmt))
    {
        echo "Login insertion successful";
        //Sending verification email
        $subject = "Rustom Email Verification";
        $message = "Hello $d_name, you are one step away from Rustoming! <a href= 'https://localhost/CARS/verify.php?vkey=$vkey'>Click Here</a> to verify your email address and activate your account!";
        $headers = "From: thisisourprojectx@gmail.com" . "\r\n";
        // Always set content-type when sending HTML email
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        if(mail($d_email,$subject,$message,$headers))
        {
            header("Location: thankyou.php");
        }
        else
        {
            header("Location: error.php");
        }

        
        /*$login_time = "UPDATE DEALER_LOGIN SET lastloggedintime = CURRENT_TIMESTAMP() WHERE D_Email = '$d_email'" ;
        $retval = mysqli_query($conn, $login_time);
        if($retval)
        {
            //echo "Updated Successfully";
            session_start();
                   
            //storing the necessary information in session
            $_SESSION['userid'] = $dealerid;
            $_SESSION['username'] = $d_name;       
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = 'dealer';
            $_SESSION['logged_in'] = true;
            header("Location: dealer_index.php");
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

