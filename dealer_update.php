<?php
session_start();
include("dbconnect.php");
$changeflag = false;
$dealerid = $_SESSION['userid']; //getting the dealer id
$dealername = $_SESSION['username'];

$query = "SELECT * FROM dealer WHERE dealerid = $dealerid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$branch_query = "SELECT * FROM branch WHERE dealerid = $dealerid";
$branch_result = mysqli_query($conn, $branch_query);
$branch_row = mysqli_fetch_assoc($branch_result);

$branch_count = 1;

//unserialize data from the ajax request
$params = array();
parse_str($_POST['formdata'], $params);

$d_name = mysqli_real_escape_string($conn, $params['name']);
$d_phoneno =  mysqli_real_escape_string($conn, $params['phone']);
$d_website =  mysqli_real_escape_string($conn, $params['website']);
        
if($row['DName'] != $d_name || $row['PhoneNo'] != $d_phoneno || $row['Website'] != $d_website)
{
    $changeflag = true;
    $dealer_update= "UPDATE dealer SET DName=?, PhoneNo=?, Website=? WHERE dealerid = $dealerid";
    if($stmt= mysqli_prepare($conn, $dealer_update) )
    {
        //Bind the variables to prepared statements as parameters
        mysqli_stmt_bind_param($stmt, "sss", $d_name, $d_phoneno, $d_website);

        //Execute the statement
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
}
while($branch_row = mysqli_fetch_assoc($branch_result))
{
    if(0)
    {
        //branch updation code
        $changeflag = true;
    }
}

if($changeflag === false)
{
    echo "No changes made!";
}
?>