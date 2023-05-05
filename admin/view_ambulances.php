<?php
include('../config.php');
require_once "../session.php";
if(isset($_GET['accept']))
		  {
		          mysqli_query($db,"UPDATE ambulances SET status='ADDED' where name = '".$_GET['name']."'");
                  mysqli_query($db,"UPDATE ambulances SET availability='AVAILABLE' where name = '".$_GET['name']."'");
                  $_SESSION['msg']="data updated";
		  }
          if(isset($_GET['reject']))
		  {
		          mysqli_query($db,"UPDATE ambulances SET status='REJECTED' where name = '".$_GET['name']."'");
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
$sql="select * from ambulances;";
$res=mysqli_query($db,$sql);
?>
<div style="padding-top:8%;">
<h2>View Ambulances</h2><br>
<table class="table" >
<tr align="center">
    <th>Name</th>
    <th>PHONE NUMBER</th>
    <th>VEHICLE NUMBER</th>
    <th>VEHICLE TYPE</th>
    <th>LICENSE</th>
    <th>STATE</th>
    <th>CITY</th>
    <th>STATUS</th>
	<th>ACTION</th>
</tr>

<?php
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['name']; ?></td>
        <td> <?php echo $row["phonenu"]; ?></td>
        <td> <?php echo  $row["vehicleno"]  ?></td>
        <td> <?php echo $row["vehicles"] ?></td>
        <td> <?php echo $row["licenseno"]  ?></td>
        <td> <?php echo $row["state"]; ?></td>
        <td> <?php echo $row['city']; ?></td>
        <td> <?php echo $row['status']; ?></td>
        <td>
            <?php
            if($row['status']=="PENDING")
            {?>
	      <a href="view_ambulances.php?name=<?php echo $row['name']?>&accept=accept" onClick="return confirm('Are you sure you want to accept?')"class="btn btn-warning btn-xs tooltips me-3" tooltip-placement="top" tooltip="Remove">ACCEPT</i></a>
          <a href="view_ambulances.php?name=<?php echo $row['name']?>&reject=reject" onClick="return confirm('Are you sure you want to reject?')"class="btn btn-warning btn-xs tooltips" tooltip-placement="top" tooltip="Remove">REJECT</i></a>
        <?php }
        else{
            echo "NO NEED";}?>
        </div></td>
    </tr>

    
 <?php   
}
?>

</table>
</body>
</html>
