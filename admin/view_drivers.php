<?php
include('../config.php');
require_once "../session.php";
if(isset($_GET['del']))
		  {
		          mysqli_query($db,"delete from  ambulances where name = '".$_GET['name']."'");
                  mysqli_query($db,"delete from  drivers where drivername = '".$_GET['name']."'");
                  $_SESSION['msg']="data updated";
		  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

   
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
<?php
$sql="select * from drivers;";
$res=mysqli_query($db,$sql);
?>
<div style="padding-top:8%;">
<h2>View Drivers</h2><br>
<table class="table" >
<tr align="center">
	<th>ID</th>
    <th>Driver Name</th>
    <th>Email</th>
    <th>PHONE NUMBER</th>
    <th>ADDRESS</th>
    <th>ACTION</th>
</tr>

<?php
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['id']; ?></td>
        <td> <?php echo $row["drivername"]; ?></td>
        <td> <?php echo  $row["Email"]  ?></td>
        <td> <?php echo $row["Phonenu"] ?></td>
        <td> <?php echo $row["address"] ?></td>
        <td>
	      <a href="view_drivers.php?name=<?php echo $row['drivername']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-warning btn-xs tooltips" tooltip-placement="top" tooltip="Remove">Remove Driver and Ambulance</i></a>
        </div></td>
    </tr>

    
 <?php   
}
?>

</table>
</body>
</html>
