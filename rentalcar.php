<?php

include("dbconnect.php");

$carid = $_REQUEST["carid"];

//first query to select all car and its dealer details
$query = "select Name,Dname,mileage,color,status,fueltype,licenseplateno,rentamount from car inner join rentalcar inner join owns inner join dealer where owns.carid=car.carid and owns.dealerid=dealer.dealerid and car.carid=rentalcar.rentalcarid and status='available' and car.carid=$carid";   

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rustom - <?php $result["carname"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="logo.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--BOOTSTRAP CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

This is the rental car details page with query <?php echo $query ?> 

</body>

</html>