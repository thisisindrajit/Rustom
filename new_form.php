<?php

session_start();

if(!isset($_SESSION['logged_in'])||(isset($_SESSION['logged_in'])&&$_SESSION['usertype']==="customer")) //user not logged in or user logged in is a customer
{
    header('location:index.php');
}

include("dbconnect.php");

$dealerid = $_SESSION['userid']; //getting the dealer id
$dealername = $_SESSION['username'];

if(isset($_POST["submit"]))
{

$m_name = mysqli_real_escape_string($conn, $_POST["m_name"]);

$query1 = "Select manufacturerid from manufacturer where mname = '$m_name'";
$ex1 = mysqli_query($conn, $query1);
$res1 = mysqli_fetch_assoc($ex1);

$m_id = $res1["manufacturerid"];

$price = mysqli_real_escape_string($conn, $_POST["price"]);

//prepared statement
$prepstat = "insert into car(name,cartype,mileage,color,status,fueltype,manufacturedate,manufacturerid) values (?,'new',?,?,'available',?,?,?)";

if($stmt = mysqli_prepare($conn, $prepstat))
{

//binding variables
$name = mysqli_real_escape_string($conn, $_POST["name"]);
$color = mysqli_real_escape_string($conn, $_POST["color"]);
$mileage = mysqli_real_escape_string($conn, $_POST["mileage"]);
$m_date = mysqli_real_escape_string($conn, $_POST["m_date"]);
$fueltype = mysqli_real_escape_string($conn, $_POST["fueltype"]);

//echo $name." ".$color." ".$mileage." ".$m_date." ".$fueltype." ".$price." ".$m_id;

mysqli_stmt_bind_param($stmt, "ssssss", $name,  $mileage, $color, $fueltype, $m_date, $m_id);

    if(mysqli_stmt_execute($stmt))
    {
        //echo "Inserted successfully into cars table";

        $query2 = "Select carid from car where name = '$name' order by uploadedtime desc limit 1";
        $ex2 = mysqli_query($conn, $query2);
        $res2 = mysqli_fetch_assoc($ex2);

        $car_id = $res2["carid"];


        $ownsquery = "insert into owns values ($car_id,$dealerid)";

        if(mysqli_query($conn, $ownsquery))
        {

          $priceinsertquery = "insert into newcar(newcarid,price) values ($car_id,$price)";
        
        
            if(mysqli_query($conn, $priceinsertquery))
            {
            //echo "Inserted successfully into newcar table!";
            
            $f1 = mysqli_real_escape_string($conn, $_POST["f1"]);
            $f2 = mysqli_real_escape_string($conn, $_POST["f2"]);
            $f3 = mysqli_real_escape_string($conn, $_POST["f3"]);
            $f4 = mysqli_real_escape_string($conn, $_POST["f4"]);

            $featuresarr = array($f1,$f2,$f3,$f4);

            $i = 0;

            while($i<4)
            {

              $featurequery = "insert into features values ($car_id,'$featuresarr[$i]')";
        
                if(!mysqli_query($conn, $featurequery))
                {
                  echo "Error while inserting feature into table!";
                }
   

                $i++;
            }


            //inserting image into table

            if(isset($_FILES['carimage']))
            {
              $target_dir = "Images/";
              $file_name = $_FILES['carimage']['name']; //original name of file in client's computer
              $file_tmp = $_FILES['carimage']['tmp_name'];  //temp name stored in server until processing

              $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
              {
              echo "Sorry only JPG, JPEG, PNG files are allowed.";
              }

              else
              {

              if(!is_dir($target_dir. $car_id ."/")) { //creating a new directory for that car
                  mkdir($target_dir. $car_id ."/");
              }

              $target_dir = $target_dir. $car_id."/"; //changing the target directory

              $newfilename="1.".$imageFileType;
              move_uploaded_file($file_tmp, $target_dir.$newfilename); //uploading file to the given directory

              $imgpath=$target_dir.$newfilename;

              $imageinsert = "insert into images(carid,images) values ($car_id,'$imgpath')";

              if($imageex= mysqli_query($conn, $imageinsert))
              {
                $_SESSION['newcaradded'] = true;
                header("location:dealer_index.php");
              }

              else
              {
                echo "some error occured while inserting image path in database!";
              }

              }

            }


            $_SESSION['newcaradded'] = true;
            header("location:dealer_index.php");
            }

            else
            {
            echo "Some error occurred while inserting data!" . mysqli_error($conn);
            }

        }

        else
        {
            echo "Some error occurred while inserting data in owns table!";
        }
        
    }
    else
    {
        echo "Error: Could not execute the query: " . mysqli_error($conn);
    }

}

}




?>



<!DOCTYPE html>
<html>
  <head>
    <title>Add New Car - Rustom</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      font-size: 36px;
      color: #fff;
      z-index: 2;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 20px 0 #333; 
      }
      .banner {
      position: relative;
      height: 210px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, textarea, select {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color: #333;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #333;
      color: #333;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #a9a9a9;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 0;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
      }
      input[type="time"]::-webkit-inner-spin-button {
      margin: 2px 22px 0 0;
      }
      input[type=radio], input.other {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 10px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      #radio_5:checked ~ input.other {
      display: block;
      }
      input[type=radio]:checked + label.radio:before {
      border: 2px solid #444;
      background: #444;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 7px;
      left: 5px;
      width: 7px;
      height: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #444;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #666;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
    </style>
  </head>
  <body>
    <div class="testbox">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="banner">
          <h1>New Car Form</h1>
        </div>
        <div class="item">
          <b>Car Details:</b>
          <div class="name-item">
            <input type="text" name="name" placeholder="Car Name (along with manufacturer name | eg - Ford EcoSport)" required>
            <input type="text" name="m_name" placeholder="Manufacturer Name"  required/>
          </div>
          <div class="name-item">
            <input type="text" name="color" placeholder="Color"  required/>
            <input type="number" name="mileage" placeholder="Mileage" step="0.1" min="0"  required>
          </div>
        </div>

      <div class="item">
        Manufacture Date
        <input type="date" name="m_date" required>
      </div>

        <div class="item">
          Fuel Type
        	<select name="fueltype" required>
              <option value="petrol" selected>Petrol</option>
              <option value="diesel">Diesel</option>
            </select>
		</div>
		<div class="item">
          <input type="number" name="price" placeholder="On-road price (in numbers only)" min="0"  required>
        </div>      
        
        
        <b>FEATURES (required)</b>
        <div class="name-item">
          <input type="text" name="f1" placeholder="Car feature 1"  required>
          <input type="text" name="f2" placeholder="Car feature 2" required>
        </div>

        <div class="name-item">
          <input type="text" name="f3" placeholder="Car feature 3" required>
          <input type="text" name="f4" placeholder="Car feature 4" required>
        </div>

        <div class="item">
        Choose a car image (optional)
          <input type="file" name="carimage">
        </div>

        <div class="btn-block">
          <button type="submit" name="submit">ADD</button>
        </div>
      </form>
    </div>
  </body>
</html>