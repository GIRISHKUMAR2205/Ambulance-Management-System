<?php
require_once "../config.php";
require_once "../session.php";
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$phonenu=$_SESSION['phonenu'];
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
 $name= trim($_POST['name']);
    $phonenu=trim($_POST['phonenu']);
    $vehicleno=trim($_POST['vehicleno']);
    $vehicles=trim($_POST['vehicles']);
    $licenseno=trim($_POST['licenseno']);
    $state=trim($_POST["state"]);
    $city=trim($_POST["city"]);
    $status="PENDING";
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO ambulances (name,phonenu,vehicleno,vehicles,licenseno,state,city,status) VALUES( ?,?, ?, ?,?,?,?,?);");
               $insertQuery->bind_param("ssssssss",$name,$phonenu,$vehicleno,$vehicles,$licenseno,$state,$city,$status);
               $result=$insertQuery->execute();
               if($result){
                $success='
                <script>if($result)
                {   
 $(document).ready(function(){
     $("#myModal").modal("show");
 });}</script>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Successfully registered
                      </div>
                    </div>
                  </div>
                </div>';
                echo "$success";
               }else{
                   $error='<pclass="error">Something went wrong!</p>';
                   echo "$error";
               }
            }
    $insertQuery->close();
        }
            ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ambulance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script></head>
<body>
<div class="wrapper">
      <nav>
        <a href="./driver_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
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
            <?php }
             elseif ($row['status']=="COMPLETED") {
            }else
            {?>
            <li><a href="./patient_request.php" class="position-relative">Patient Request for Ambulance</a></li><?php }}?>
            <li><a href="./add_ambulance.php">Add Ambulance</a></li>
            <li><a href="./ambulance_status.php">Ambulance Status</a></li>
            <li><a href="./view_ambulance.php">View Ambulance</a></li>
            <li><a href="./apply_leave.php">Leave Application</a></li>
            <li><div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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

        
    <div class="container-fluid" style="padding-top: 8%;">
  <div class="row align-items-start">
    <div class="col" >
      <img src="https://static.vecteezy.com/system/resources/previews/006/582/989/original/emergency-ambulance-on-white-background-free-vector.jpg" alt="" style="width: 100%;padding-top:10%;">
    </div>
    <div class="col ms-1">
      
    
      <form action="" method="post">  
        <h2>Add Ambulance</h2><br>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="name" placeholder="GIRISH" readonly value="<?php echo $name; ?>">
        <label for="floatingInput"> Driver Name </label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="phonenu" placeholder="name@example.com" readonly value="<?php echo $phonenu; ?>">
        <label for="floatingInput">Mobile Number</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="vehicleno" placeholder="AP26BP0002">
        <label for="floatingInput">Ambulance Vehicle No</label>
      </div>
      <div class="form-floating mb-3">
      <input list="vehicles" class="form-control" name="vehicles" id="floatinginput" placeholder="Basic Ambulance"></input>
      <label for="floatinginput">Ambulance Vehicle Type</label>
      <datalist id="vehicles">
      <option value="Basic Ambulance">
    <option value="Advance Ambulance">
    <option value="Mortuary Ambulance">
    <option value="Neonatal Ambulance">
    <option value="Patient Transport Ambulance">
      </datalist>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="licenseno" placeholder="L2541" required>
        <label for="floatingInput">License No</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="state" placeholder="name@example.com" required>
        <label for="floatingInput">State</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="city" placeholder="Password" required>
        <label for="floatingInput">City</label>
      </div>
      <input type="submit" name =submit value="Book Ambulance" class="btn btn-primary mt-2">
    </form>
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
</html>