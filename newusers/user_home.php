<?php

session_start();
if(!isset($_SESSION['id']) || $_SESSION["id"] != true )
{
    header("location: user_login.php");
    exit;
}
$name= $_SESSION["name"];
$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<style>
 .z> img{
  object-fit: contain;
  }
</style>
</head>
<body>
    <div class="wrapper">
      <nav>
        <a href="./user_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <input type="checkbox" name="" id="toggle">
        <label for="toggle"><i class="material-icons">menu</i></label>
        <div class="menu" >
          <ul>
            <li><a href="./DBook_ambulance.php">My Location</a></li>
            <li><a href="./book_ambulance.php">Book Ambulance</a></li>
            <li><a href="./search_ambulance.php">Search Ambulance </a></li>
            <li><a href="./view_ambulance.php">View Ambulance</a></li>
            <li><a href="./booking_status.php">Booking Status</a></li>
            <li><a href="./feedback.php">Feedback/Complaint</a></li>
            <li><div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Profile
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="./changepassword.php">Change Password</a></li>
    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
  </ul>
</div></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="z">
      <img src="https://karunyamedservices.com/wp-content/uploads/2020/06/653c250e8c6372d5fb6f1927637ffa01.jpg" width="100%" alt="">
    </div>
</body>
    <style>
        *,
*::before,
*::after {
margin: 0;
padding: 0;
}
.wrapper {
  width: 100vw;
  margin: 0 auto;
  position: fixed;
  z-index: 999;
}
nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  background-color: hsl(240, 2%, 8%);
  padding: 1rem 1.5rem;
  width: 100%;
}
nav .logo  {
  font-weight: 700;
}
nav ul {
  list-style: none;
  display: flex;
  padding-top: 15px;
  gap: 2rem;
}
nav a {
  text-decoration: none;
  color: white;
}
nav #toggle,
nav label {
  display: none;
}
.menu li{
  font-size: medium;
}
.bottom-right {
  position: absolute;
  bottom: 275px;
  right: 175px;
  color: black;
  font-size: 35px;
}
    </style>
</body>
</html>