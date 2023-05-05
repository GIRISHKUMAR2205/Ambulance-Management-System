<?php
include_once("../config.php");
require_once "../session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
$sql="select * from feedback;";
$res=mysqli_query($db,$sql);
?>
<div style="padding-top:8%;">
  <h2>Patient Feedback/Complaints</h2><br>
<table class="table" >
<tr align="center">
	<th>PATIENT ID</th>
    <th>PATIENT Name</th>
    <th>PHONE NUMBER</th>
    <th>VEHICLE NO</th>
    <th>DRIVER NAME</th>
    <th>CHOICE</th>
    <th>DESCRIPTION</th>
</tr>

<?php
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['patientid']; ?></td>
        <td> <?php echo $row['patientname']; ?></td>
        <td> <?php echo $row["phonenu"] ?></td>
        <td> <?php echo $row['vehicleno']; ?></td>
        <td> <?php echo $row["drivername"]; ?></td>
        <td> <?php echo  $row["choice"]  ?></td>
        <td> <?php echo $row["description"] ?></td>
    </tr>

    
 <?php   
}
?>

</table>
</body>
</html>