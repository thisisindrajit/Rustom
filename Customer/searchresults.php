<?php

include("dbconnect.php");

$query = '%'.$_POST["query"].'%';
$cusid = $_POST["cusid"];
 
$stmt = $conn->prepare("select car.carid,name,cartype,status,images from car inner join images where car.carid=images.carid and images=(select images from images where carid=car.carid limit 1) and name like ?");
$stmt->bind_param("s",$query);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows===0)
{
$output = '<div style="border:1px solid red;margin-top:15px;padding:10px 0;text-align:center;font-size:1.2rem;font-weight:lighter;color:red">No cars found!</div>';
}

else
{

$output = "<div class='row'>";

while($row = $result->fetch_array(MYSQLI_ASSOC))
{

//setting link 

if($row["cartype"]==='new')
{
    $link="newcar.php?cusid=".$cusid."&carid=".$row["carid"];
}

else if($row["cartype"]==='resale')
{
    $link="resalecar.php?cusid=".$cusid."&carid=".$row["carid"];
}

else
{
    $link="rentalcar.php?cusid=".$cusid."&carid=".$row["carid"];
}

$output .= '

<div class="col-sm-3">
    
<div class="card">

<img src="../'.$row["images"].'" class="card-img-top" alt="Car image">
<div class="card-body">
<h5 class="card-title">'.$row["name"].'</h5>
<h6 class="card-subtitle mb-2">'.$row["status"].' | TYPE : '.$row["cartype"].'</h6><hr><a href="'.$link.'" class="card-link">More Details</a>
</div>
</div>
</div>';

}

$output .= "</div>";

}


echo $output;

$stmt->close();

?>
