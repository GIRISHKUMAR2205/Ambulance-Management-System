<?php
//require_once "session.php";
session_start();
ob_start();
require_once "../config.php";
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $Password = trim($_POST['Password']);

    if(empty($username))
    {
        $error="Pls enter username";
        //echo "$error";
    }
    if(empty($Password))
    {
        $error="Pls enter password";
        //echo "$error";
    }
    if(empty($error))
    {
        if($query = $db->prepare("SELECT * FROM admins WHERE username=?"))
        {
            
            $query->bind_param('s', $username);
            $query->execute();
            //$query->store_result();
            $query->bind_result($id,$username,$password,$null);
             $null="Fatal error: Uncaught Error: mysqli_stmt::bind_result():
              Argument #5 cannot be passed by reference in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php:28 
             Stack trace: #0 {main} thrown in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php on line 28 
             if we add timestamp to database we need to assign like null thats no use is used 
             To bypass error";
            $row=$query->fetch();
            
            if($row)
            {
                
                if(password_verify($Password,$password) or($Password==$password)){
                  if(!empty($_POST["remember"])) {
                  setcookie ("user_login",$_POST["username"],time()+ (10 *  24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["Password"],time()+ (10 *  24 * 60 * 60));
$_SESSION['id']=$id;
header("Location: admin_home.php");
exit();
}

 else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
				}
			}
      $_SESSION['id']=$id;
      header("Location: admin_home.php");
      exit();}}

                else{
                    $error="Password is not valid";
                    echo $error;
                }
            }else{
                $error="No user existed with username";
                echo "$error";
            }
        }$query->close();
    }
    mysqli_close($db);
}

?>







<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

	</head>
	<body>

    <div class="wrapper">
      <nav>
      <a href="../home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu">
          <ul>
            <li><a href="../newusers/user_login.php">User Login</a></li>
            <li><a href="../drivers/driver_login.php">Driver Login</a></li>
            <li><a href="../admin/admin_login.php">Admin Login</a></li>
            <li><a href="../home.php#contact">Help</a></li>
          </ul>
        </div>
      </nav>
    </div>

		<section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
          <h2 class="d-flex justify-content-end align-items-end">Admin Login</h2>
            <img src="../assets/images/draw2.webp"
              class="img-fluid" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="post">    
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
                  placeholder="Enter a valid username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" required />
                <label class="form-label" for="form3Example3">Username</label>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-3">
                <input type="password" name="Password" id="form3Example4" class="form-control form-control-lg"
                  placeholder="Enter password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"  required/>
                <label class="form-label" for="form3Example4">Password</label>
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox"  name="remember" id="form2Example3" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
                  <label class="form-check-label" for="form2Example3">
                    Remember me
                  </label>
                </div>
                <!--<a href="#!" class="text-body">Forgot password?</a>-->
              </div>
    
              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" name="submit" class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              </div>
    
            </form>
          </div>
        </div>
      </div>
      <div 
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-center py-4 px-4 px-xl-5">
        <!-- Copyright -->
        <div class="mb-3 mb-md-0 " style="color:#ccc;"> 
          Copyright © 2023. All rights reserved.
        </div>
        <!-- Copyright -->
      </div>
    </section>

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