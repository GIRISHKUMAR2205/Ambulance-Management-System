<?php
require_once "../config.php";
require_once "../session.php";
$id=$_SESSION['id'];
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
{
    $pass = trim($_POST['pass']);
    $npass = trim($_POST['npass']);
    $cnpass = trim($_POST['cnpass']);
    if(empty($pass))
    {
        $error="Pls enter current password";
        //echo "$error";
    }
    if(empty($npass))
    {
        $error="Pls enter new password";
        //echo "$error";
    }
    if(empty($error)&&($npass!=$cnpass)){
        $error='<pclass="error">Password did not match.</p>';
        echo "$error";
    }
    if(empty($error))
    {
        if($query = $db->prepare("SELECT * FROM admins WHERE id=?"))
        {
            $query->bind_param('s', $id);
            $query->execute();
            //$query->store_result();
            $query->bind_result($id,$username,$password,$null);
             $null="Fatal error: Uncaught Error: mysqli_stmt::bind_result():
              Argument #5 cannot be passed by reference in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php:28 
             Stack trace: #0 {main} thrown in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php on line 28 
             To bypass error we need assign value that is the reaso we pass null its no use";
            $row=$query->fetch();
            
            if($row)
            {
                $query->close();
                if($pass==$password)
                {
                    $Password=password_hash($cnpass,PASSWORD_BCRYPT);  
                    if($con=mysqli_query($db,"update admins set Password='$Password' where id='$id'"))
                    {
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
                                Password Successfully Changed
                              </div>
                            </div>
                          </div>
                        </div>';
                        echo "$success";
                    }
                    else
                    {
                        echo "Error updating record: " . $db->error;
                        echo "PASSWORD NOT UPDATED";
                    }
                }
                elseif(password_verify($pass,$password))
                {
                    $Password=password_hash($cnpass,PASSWORD_BCRYPT);  
                    if($con=mysqli_query($db,"update admins set Password='$Password' where id='$id'"))
                    {
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
                              Password Successfully Changed
                            </div>
                          </div>
                        </div>
                      </div>';
                      echo "$success";
                    }
                    else
                    {
                        echo "Error updating record: " . $db->error;
                        echo "PASSWORD NOT UPDATED";
                    }
                }
                else{
                    $error="Current Password doesnot match";
                    echo $error;
                }
            }
            else
                {
                echo "Can't change password";
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Change Password</title><script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script>
</head>
<body>
<div class="wrapper">
      <nav>
        <a href="./admin_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu" >
          <ul>
              <li><a href="./view_drivers.php">View Drivers</a></li>
            <li><a href="./view_ambulances.php">View Ambulances</a></li>
            <li><a href="./view_patients.php">View Patients</a></li>
            <li><a href="./patient_feedback.php">Patient Feedback/Complaints</a></li>
            <li><a href="./leave_approve.php">Leaves To Approve</a></li>
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
<div style="display:flex; justify-content:center;padding-top:10vw; align-items:center;">
    <div class="card text-center" style="width: 500px; ">
        <div class="card-header h5 text-white bg-primary">Change Password</div>
        <div class="card-body px-5">
        <div class="form-outline">
            <form action="" method="POST">
                <label class="form-label" for="typeEmail">Current Password</label>
            <input type="password" id="typeEmail" class="form-control my-3" name=pass required/>
            <label class="form-label" for="typeEmail">New Password</label>
            <input type="password" id="typeEmail" class="form-control my-3" name=npass required/>
            <label class="form-label" for="typeEmail">Confirm Password</label>
            <input type="password" id="typeEmail" class="form-control my-3" name=cnpass required />
            <input  type="submit" name="submit" value="Change"  class="btn btn-primary w-100"></input>
    </form>
        </div>
        <div style="padding-top: 30px;">
            <a   href="admin_home.php"  class="btn btn-primary w-100">Home</a>
        </div>
    </div>
</div>
</div>
</body>
<style>
    body{
        background-color: #fbf8f8;
    }
</style>
</html>