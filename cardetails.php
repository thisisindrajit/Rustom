<?php

include("dbconnect.php");

$query="select car.carid,name,cartype,status,images from car inner join images where car.carid=images.carid and
 images=(select images from images where carid=car.carid limit 1)"; //to select cars along with its status

if($result = $conn->query($query))
{
    $arr = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $featurequery = "select features from features where carid=".$row["carid"]." limit 3";
        $featureresult = $conn->query($featurequery);
        $featuresarr= array();

        if($featureresult)
        {
        while($features = $featureresult->fetch_array(MYSQLI_ASSOC))
        {
               $featuresarr[] = $features["features"];   
        }

        $row["features"] =  $featuresarr;
        }
    
        $arr[] = $row;
    }

    echo json_encode($arr);
}

?>