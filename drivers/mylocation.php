<?php
include_once('../config.php');
session_start();
if(!isset($_SESSION['id']) || $_SESSION["id"] != true )
{
    header("location: driver_login.php");
    exit;
}
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$phonenu=$_SESSION['phonenu'];
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$address=$_SESSION['address'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Home Page
        </title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="wrapper">
      <nav>
        <a href="./driver_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <input type="checkbox" name="" id="toggle">
        <label for="toggle"><i class="material-icons">menu</i></label>
        <div class="menu" >
          <ul>
          <li><a href="./mylocation.php">My Location</a></li>
          <?php
          $sql="select * from patients;";
          $res=mysqli_query($db,$sql);
          while($row = mysqli_fetch_array($res))
          {
           if($row['status']=="ASSIGNED"){?>
            <li><a href="./patient_request.php" class="position-relative">Patient Request for Ambulance<span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span></a></li>
            <?php } elseif ($row['status']=="COMPLETED") {
            }else
            {?>
            <li><a href="./patient_request.php" class="position-relative">Patient Request for Ambulance</a></li><?php }}?>
            <li><a href="./add_ambulance.php">Add Ambulance</a></li>
            <li><a href="./ambulance_status.php">Ambulance Status</a></li>
            <li><a href="./view_ambulance.php">View Ambulance</a></li>
            <li><a href="./apply_leave.php">Leave Application</a></li>
            <li><div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
    Profile
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="./changepassword.php">Change Password</a></li>
    <li><a class="dropdown-item" href="./driver_logout.php">Logout</a></li>
  </ul>
</div></li>
          </ul>
        </div>
      </nav>
    </div>

    <div style="padding-top:8vw;">
      <div class="container text-center">
        <div class="row align-items-start">
          <div class="col">
      <h2>My Location</h2><br>

      <div class="row">
        <div class="title">Updated</div>
        <div class="data" id="date"></div>
      </div>
      <div class="row">
        <div class="title">Latitude, Longitude</div>
        <div class="data">
          <span id="lat"></span>, <span id="lng"></span>
        </div>
      </div>
    </div>



    <div class="col">
    <h2>User Location</h2><br>
    <iframe src="./admin.php" title="Iframe Example1" height="550"></iframe>
    </div>
  </div>
</div>


    <script>
       var uid=<?php echo $id; ?>;
       var phonenu=<?php echo $phonenu; ?>;
       <?php
       echo "var name ='$name';";
       echo "var email ='$email';";
       echo "var phonenu ='$phonenu';";
       echo "var username ='$username';";
       echo "var password ='$password';";
       echo "var address ='$address';";
   ?>
        var track = {
  // (A) INIT
  rider : uid,   // rider id - fixed to 999 for demo
  delay : 1000, // delay between gps update (ms)
  timer : null,  // interval timer
  hDate : null,  // html date
  hLat : null,   // html latitude
  hLng : null,   // html longitude
  init : () => {
    // (A1) GET HTML
    track.hDate = document.getElementById("date");
    track.hLat = document.getElementById("lat");
    track.hLng = document.getElementById("lng");

    // (A2) START TRACKING
    track.update();
    track.timer = setInterval(track.update, track.delay);
  },

  // (B) SEND CURRENT LOCATION TO SERVER
  update : () => navigator.geolocation.getCurrentPosition(
    pos => {
      // (B1) LOCATION DATA
      var data = new FormData();
      data.append("req", "update");
      data.append("id", track.rider);
      data.append("name",name);
      data.append("username",username);
      data.append("email",email);
      data.append("phonenu",phonenu);
      data.append("password",password);
      data.append("address",address);
      data.append("lat", pos.coords.latitude);
      data.append("lng", pos.coords.longitude);

      // (B2) AJAX SEND TO SERVER
      fetch("ajax_track.php", { method:"POST", body:data })
      .then(res => res.text())
      .then(txt => { if (txt=="OK") {
        let now = new Date();
        track.hDate.innerHTML = now.toString();
        track.hLat.innerHTML = pos.coords.latitude;
        track.hLng.innerHTML = pos.coords.longitude;
      } else { track.error(txt); }})
      .catch(err => track.error(err));
    },
    err => track.error(err)
  ),

  // (C) HELPER - ERROR HANDLER
  error : err => {
    console.error(err);
    alert("An error has occured, open the developer's console.");
    clearInterval(track.timer);
  }
};
window.onload = track.init;
    </script>
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