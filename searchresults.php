<?php

include("dbconnect.php");

$query = '%'.$_POST["query"].'%';
$cusid = $_POST["cusid"];
 
$stmt = $conn->prepare("select car.carid,name,cartype,status,images from car left join images on car.carid=images.carid and images=(select images from images where carid=car.carid limit 1) having name like ? or car.cartype like ?");
$stmt->bind_param("ss",$query,$query);
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

if($row["images"]===null)
{
    $row["images"]="dummy.png";
}

//setting link 

if($row["cartype"]==='new')
{
    $link="newcar.php?carid=".$row["carid"];
}

else if($row["cartype"]==='resale')
{
    $link="resalecar.php?carid=".$row["carid"];
}

else
{
    $link="rentalcar.php?carid=".$row["carid"];
}

//setting color
if($row["status"]==="rented" || $row["status"]==="sold out")
{
    $statuscolor="#E74C3C";
}

else
{
    $statuscolor="#2ECC71";
}


$output .= '

<div class="col-sm-3">
    
<div class="card">

<img src="'.$row["images"].'" class="card-img-top" alt="Car image">
<div class="card-body">
<h5 class="card-title">'.$row["name"].'</h5>
<h6 class="card-subtitle mb-2"><span style="color:'.$statuscolor.'">'.$row["status"].'</span> | TYPE : '.$row["cartype"].'</h6><hr><a href="'.$link.'" class="card-link">More Details</a>
</div>
</div>
</div>';

}

$output .= "</div>";

}


echo $output;

$stmt->close();

?>
