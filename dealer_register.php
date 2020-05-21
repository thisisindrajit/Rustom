<?php
if(isset($_POST["dealerRegister"]))
{

include("dbconnect.php");

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
        //echo "Inserted successfully";
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
        }
    }
}
else
{
    echo "Error: Could not prepare the query: " . mysqli_error($conn);
}

//Inserting into dealer login
$dealer_login = "INSERT INTO DEALER_LOGIN (D_Email, Password) VALUES (?, ?)";

if($stmt = mysqli_prepare($conn, $dealer_login))
{
    mysqli_stmt_bind_param($stmt, "ss", $d_email, $d_password); 
    $d_password = mysqli_real_escape_string($conn, $_REQUEST['D_password']);
      
    if(mysqli_stmt_execute($stmt))
    {
        //echo "Login insertion successful";
        
        $login_time = "UPDATE DEALER_LOGIN SET lastloggedintime = CURRENT_TIMESTAMP() WHERE D_Email = '$d_email'" ;
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
}
else
{
    header("location: register.html");
}
?>

