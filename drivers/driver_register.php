<?php
require_once "../config.php";
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
 $name= trim($_POST['name']);
    $Email=trim($_POST['Email']);
    $phonenu=trim($_POST['phonenu']);
    $address=trim($_POST['address']);
    $username=trim($_POST['username']);
    $Password=trim($_POST['Password']);
    $Cnfm_Password=trim($_POST["Cnfm_Password"]);
    $password_hash=password_hash($Password,PASSWORD_BCRYPT);
    if($query=$db->prepare("SELECT * FROM drivers WHERE Email=?")){
        $error='';
    $query->bind_param('s',$Email);
    $query->execute();
    $query->store_result();
        if($query->num_rows>0){
            $error='<p class="error">The email  is already registered!</p>';
            echo "$error";
        }else{
            // Validate password
            if(strlen($Password)<6){
                $error='<p class="error">Password must have at least6characters.</p>';
                echo "$error";
           }
        }
    }
           // Validate confirm password
           if(empty($Cnfm_Password)){
               $error='<pclass="error">Please enter confirm password.</p>';
               echo "$error";
           }else{
               if(empty($error)&&($Password!=$Cnfm_Password)){
                   $error='<pclass="error">Password did not match.</p>';
                   echo "$error";
               }
           }
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO drivers (drivername,Email,phonenu,address,username,Password) VALUES( ?, ?, ?,?,?,?);");
               $insertQuery->bind_param("ssssss",$name,$Email,$phonenu,$address,$username,$password_hash);
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
    $query->close();
    $insertQuery->close();
    // Close DB connection
    mysqli_close($db);
            }
            ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Driver Register</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script>
	</head>
	</head>
	<body>
    <div class="wrapper">
      <nav>
      <a href="../home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="55px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu">
          <ul>
            <li><a href="../newusers/user_login.php">User Login</a></li>
            <li><a href="../drivers/driver_login.php">Driver Login</a></li>
            <li><a href="../admin/admin_login.php">Admin Login</a></li>
            <li><a href="../home.php#contact" style="padding-right: 35px;">Help</a></li>
          </ul>
        </div>
      </nav>
    </div>
        <section class="vh-100" style="background-color: #eee;">
  <div style="padding-top: 65px;" class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h2 fw-bold mb-4 mx-1 mx-md-3 mt-1">Driver Registration</p>

                <form method="post" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="name" type="text" id="form3Example1c" class="form-control" required/>
                      <label class="form-label" for="form3Example1c">Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Email" type="email" id="form3Example3c" class="form-control" required/>
                      <label class="form-label" for="form3Example3c">Email</label>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="phonenu" type="text" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Phone Number</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="address" type="text" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Address</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="username" type="text" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Username</label>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Password" type="password" id="form3Example4c" class="form-control" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-1">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Cnfm_Password" type="password" id="form3Example4cd" class="form-control" required/>
                      <label class="form-label" for="form3Example4cd">Confirm password</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-1 mb-lg-1">
                    <button type="submit" name="submit" class="btn btn-primary btn-md">Register</button>
                  </div>
                  <div style="display:grid;place-items:center;">
                    <span>
                      <b>Already have an account? </b><a href="./driver_login.php" class="link-danger text-decoration-none"><b>Login</b></a><br>
                    </span>
                  </div>
                  </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="../assets/images/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	</body>
  <style>
    *,
*::before,
*::after {
  margin: 0;
  padding: 0;
}
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
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