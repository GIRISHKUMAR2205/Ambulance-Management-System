<?php
require_once "../config.php";
require_once "../session.php";
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$phonenu=$_SESSION['phonenu'];
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $pid= trim($_POST['pid']);
    $pname=trim($_POST['pname']);
    $phone=trim($_POST['phone']);
    $vehicle=trim($_POST['vehicle']);
    $dname=trim($_POST["dname"]);
    //$licenseno=trim($_POST['licenseno']);
    $choice=trim($_POST["choice"]);
    $description=trim($_POST['description']);
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO feedback (patientid,patientname,phonenu,vehicleno,drivername,choice,description) VALUES( ?,?, ?, ?,?,?,?);");
               $insertQuery->bind_param("sssssss",$pid,$pname,$phone,$vehicle,$dname,$choice,$description);
               $result=$insertQuery->execute();
               mysqli_query($db,"UPDATE ambulances SET availability='AVAILABLE' where vehicleno = '$vehicle'");
               mysqli_query($db,"UPDATE patients SET status='COMPLETED' WHERE bookedby='$name' and vehicleno = '$vehicle'");
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
                        Successfully submitted
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
    <title>Feedback</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
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

  <div style="padding-top: 8%;">
  <h2>Feedback/Complaints</h2>
    <div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
      <img src="https://imgs.search.brave.com/fqFlze-D7VkAC_-gi7qLjV-FqVKziHfG8RG0AJz8Js8/rs:fit:326:225:1/g:ce/aHR0cHM6Ly9zdGhk/b3duc3BzLnNhLmVk/dS5hdS93cC1jb250/ZW50L3VwbG9hZHMv/ZmVlZGJhY2stY29t/cGxhaW50LnN2Zw.svg" alt="Feedback" style="width:fit-content; padding-top:150px;padding-right:65px">
    </div>
    <div class="col">
      <form action="" method="post">
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingInput" name="pid" required readonly placeholder="name@example.com" value="<?php echo $id;?>">
          <label for="floatingInput" required>Patient ID</label>
        </div>
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingInput" name="pname" required readonly placeholder="Name" value="<?php echo $name;?>">
          <label for="floatingInput" required>Patient Name</label>
        </div>
<div class="form-floating mb-2">
  <input type="text" class="form-control" id="floatingInput" required name="phone" readonly placeholder="+9121052205" value="<?php echo $phonenu;?>">
  <label for="floatingInput" required>Mobile No</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" name="vehicle" required placeholder="Name">
  <label for="floatingInput" required>Ambulance Vehicle No</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" name="dname" required placeholder="Name">
  <label for="floatingInput" required>Driver Name</label>
</div>
<select class="form-select mb-3" name="choice" aria-label="Default select example">
  <option value="Feedback">Feedback</option>
  <option value="Complaint">Complaint</option>
</select>
<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>
  <div class="form-floating mt-3">
  <input type="submit" name =submit value="Submit" class="btn btn-primary w-100"><br>
  </div>
</form>
</div>
</div>
  </div>
</div>



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