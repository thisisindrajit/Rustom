<?php

include("dbconnect.php");

$query="select carid,name,mname,status from car natural join manufacturer"; //to select cars along with their manufacturers and status

/*function findfeatures($id)
{
    $featurearr = array();

    $featurequery = "select features from features where carid=$id limit 3";
    $featureresult = $conn->query($featurequery);

    if($featureresult)
    {
        while($featurerow = $featureresult->fetch_array(MYSQLI_ASSOC))
        {
            $featurearr[] = $featurerow;
        }
    }

    return $featurearr;
}*/

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