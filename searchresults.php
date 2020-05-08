<?php

include("dbconnect.php");

$query = '%'.$_POST["query"].'%';

$stmt = $conn->prepare("select carid,name,cartype,status from car where name like ?");
$stmt->bind_param("s",$query);
$stmt->execute();

$result = $stmt->get_result();

/*if($result->num_rows===0)
{
$output = "No cars found!";
}

else
{*/

$output = "<div class='row'>";

while($row = $result->fetch_array(MYSQLI_ASSOC))
{

$output .= '

<div class="col-sm-3">
    
<div class="card">

<img src="dummy.png" class="card-img-top" alt="Car image">
<div class="card-body">
<h5 class="card-title">'.$row["name"].'</h5>
<h6 class="card-subtitle mb-2">'.$row["status"].' | TYPE : '.$row["cartype"].'</h6><hr><a href="#" class="card-link">More Details</a>
</div>
</div>
</div>';

}

$output .= "</div>";


echo $output;

$stmt->close();

?>
