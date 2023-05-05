<?php
require_once "../config.php";
require_once "../session.php";
$bname=$_SESSION['name'];
$vehicleno=$_GET['vehicleno'];
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $paname= trim($_POST['name']);
    $phonenu=trim($_POST['phonenu']);
    $patientdes=trim($_POST['patientdes']);
    $vehicleno=trim($_POST['vehicleno']);
    //$licenseno=trim($_POST['licenseno']);
    $pickupadd=trim($_POST["pickupadd"]);
    $destadd=trim($_POST["destadd"]);
    $charges=trim($_POST['charges']);
    $status="ASSIGNED";
    $bookedby=$bname;
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO patients (pname,phonenu,vehicleno,patientdescripton,pickupaddress,destinationaddress,charges,status,bookedby) VALUES( ?,?,?, ?, ?,?,?,?,?);");
               $insertQuery->bind_param("sssssssss",$paname,$phonenu,$vehicleno,$patientdes,$pickupadd,$destadd,$charges,$status,$bookedby);
               $result=$insertQuery->execute();
               mysqli_query($db,"UPDATE ambulances SET availability='NOT AVAILABLE' where vehicleno = '$vehicleno'");
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
    <title>Booking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script>
</head>
<body>
<div class="wrapper">
      <nav>
        <a href="./user_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
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
    <div class="container-fluid" style="padding-top: 8%;">
  <div class="row align-items-start">
    <div class="col" >
      <img src="http://nationalambulance.net/wp-content/uploads/2016/12/142.jpg" alt="" style="width: 100%;padding-top:10%;">
    </div>
    <div class="col ms-1">
      
    
      <form action="" method="post">
        <h2>Book Ambulance</h2>  
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="name" placeholder="name@example.com" required>
        <label for="floatingInput"> Patient Name </label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="phonenu" placeholder="name@example.com" required>
        <label for="floatingInput">Mobile Number</label>
      </div>
      <div class="form-floating mb-3">
      <textarea class="form-control" placeholder="Leave a comment here" style="height: 100px;" name="patientdes" id="floatingTextarea"></textarea>
      <label for="floatingTextarea">Patient Description</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="vehicleno" placeholder="name@example.com" value="<?php echo $vehicleno;?>" readonly>
        <label for="floatingInput">Vehicle No</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="pickupadd" placeholder="name@example.com" required>
        <label for="floatingInput">Pickup Address</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="destadd" placeholder="name@example.com" required>
        <label for="floatingInput">Destination Address</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="charges" placeholder="Password" value="500" readonly>
        <span class="text-danger">Rs.500 for the first 10 km. For every additional kilometre, Rs.15 can be charged. </span><br>
        <label for="floatingInput">Ambulance Charges</label>
      </div>
      <input type="submit" name =submit value="Book Ambulance" class="btn btn-primary mt-3">
    </form>
  </div>
</div></div>



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