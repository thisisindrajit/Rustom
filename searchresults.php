<?php

$query = $_GET["query"];

$i=0;
$output = "";


$output = '

<div class="row" style="margin-top:25px">
<div class="col-sm-3">
    
<div class="card" style="padding:0px 0px 10px 0">

<img src="dummy.png" class="card-img-top" alt="Car image">
<div class="card-body">
<h5 class="card-title">Car Name</h5>
<h6 class="card-subtitle mb-2 text-muted">Availability Status</h6>
<p class="card-text">Car Details go here...</p>
<a href="#" class="card-link">More Details</a>
</div>
</div>

</div>

</div>';

echo $output;


?>
