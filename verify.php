<?php

if(isset($_GET['vkey']))
{
    include("dbconnect.php");
    $vkey = $_GET['vkey'];

    $customer_query = "SELECT * FROM customer_login WHERE vkey = '$vkey' AND verified = 0 LIMIT 1";
    $customer_result = mysqli_query($conn, $customer_query);
    $row = mysqli_fetch_array($customer_result, MYSQLI_ASSOC);

    if(mysqli_num_rows($customer_result) == 1)
    {
        $customer_update = "UPDATE customer_login SET verified = 1 WHERE vkey = '$vkey' AND verified = 0";
        if(mysqli_query($conn, $customer_update))
        {
            echo "Your account has been successfully verified";
        }
        else
        {
            echo "Error: Could not update: ". mysqli_error($conn);
            header("Location: error.php");
        }    
    }
    else
    {
        $dealer_query = "SELECT * FROM dealer_login WHERE vkey = '$vkey' AND verified = 0 LIMIT 1";
        $dealer_result = mysqli_query($conn, $dealer_query);
        $row = mysqli_fetch_array($dealer_result, MYSQLI_ASSOC);
    
        if(mysqli_num_rows($dealer_result) == 1)
        {
            $dealer_update = "UPDATE dealer_login SET verified = 1 WHERE vkey = '$vkey' AND verified = 0";
            if(mysqli_query($conn, $dealer_update))
            {
                echo "Your account has been successfully verified";
            }
            else
            {
                echo "Error: Could not update: ". mysqli_error($conn);
                header("Location: error.php");
            } 
        }
        else
        {
            echo "This account is invalid or already verified";
        }  
    }
}
else
{
    echo "Key has been removed from the URL sent to your mail";
    header("Location: error.php");
}


?>