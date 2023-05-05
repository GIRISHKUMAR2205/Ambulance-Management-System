<?php
include('../config.php');
require_once "../session.php";
if(isset($_GET['accept']))
		  {
		          mysqli_query($db,"UPDATE leaveapproval SET status='GRANTED' where drivername = '".$_GET['name']."' and fromdate = '".$_GET['fdate']."' and todate = '".$_GET['tdate']."' ");
                  mysqli_query($db,"UPDATE ambulances SET availability='NOT AVAILABLE' where name = '".$_GET['name']."'");
                  $_SESSION['msg']="data updated";
		  }
          if(isset($_GET['reject']))
		  {
		          mysqli_query($db,"UPDATE leaveapproval SET status='REJECTED' where drivername = '".$_GET['name']."' and fromdate = '".$_GET['fdate']."' and todate = '".$_GET['tdate']."' ");
                  $_SESSION['msg']="data updated";
		  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Leave Aprroval</title>
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
$sql="select * from leaveapproval;";
$res=mysqli_query($db,$sql);
?>
<div style="padding-top:8%;">
<h2>View Leave Approvals</h2><br>
<table class="table" >
<tr align="center">
    <th>Driver Name</th>
    <th>START DATE</th>
    <th>END DATE</th>
    <th>REASON</th>
    <th>ACTION</th>
</tr>
<?php
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['drivername']; ?></td>
        <td> <?php echo $row["fromdate"]; ?></td>
        <td> <?php echo $row["todate"] ?></td>
        <td> <?php echo $row['reason']; ?></td>
        <td>
          <?php
            if($row['status']=="PENDING")
            {?>
	      <a href="leave_approve.php?name=<?php echo $row['drivername']?>&fdate=<?php echo $row["fromdate"]?>&tdate=<?php echo $row["todate"] ?>&accept=accept" onClick="return confirm('Are you sure you want to accept?')"class="btn btn-warning me-3" >ACCEPT</i></a>
          <a href="leave_approve.php?name=<?php echo $row['drivername']?>&fdate=<?php echo $row["fromdate"]?>&tdate=<?php echo $row["todate"] ?>&reject=reject" onClick="return confirm('Are you sure you want to reject?')"class="btn btn-warning" >REJECT</i></a>
        <?php }
        else{
            echo "NO NEED";}?>
        </div>
        </td>
    </tr>

    
 <?php   
}
?>

</table>
</body>
</html>