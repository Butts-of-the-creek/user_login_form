<?php
session_start();
include("connect.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel = "stylesheet" href = "homepage.css">
</head>
<header>
  <div class = "header"
  id = "header" name = "header" >
  <div class = "header_element"  id = "menu">
     <h1>Menu</h1>
  </div>

  <div class = "header_element" id = "H">
     <h1>Home</h1>
  </div>

  <div class = "header_element" id = "H">
     <h1></h1>
  </div>

  <hr>
</header>

<body>
    <div style="text-align:center; padding:15%;">
      <p  style="font-size:50px; font-weight:bold;">
       Hello  <?php 
       if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo $row['firstName'].' '.$row['lastName'];
        }
       }
       ?>
       :)
      </p>
      <a href="logout.php">Logout</a>
    </div>
</body>
</html>